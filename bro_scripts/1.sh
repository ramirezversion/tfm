#!/usr/bin/env bash
_scriptDir="$(dirname 'readlink -f $0')"

#export DEBIAN_FRONTEND=noninteractive

if [ "$EUID" -ne 0 ]
  then echo "Please run as root"
  exit 1
fi

function Info {
  echo -e -n '\e[7m'
  echo "$@"
  echo -e -n '\e[0m'
}

function Error {
  echo -e -n '\e[41m'
  echo "$@"
  echo -e -n '\e[0m'
}


Info  "Creating directories"
mkdir -p /nsm
mkdir -p /nsm/pcap/
mkdir -p /nsm/scripts/
mkdir -p /nsm/bro/
mkdir -p /nsm/bro/logs
mkdir -p /nsm/bro/extracted/
if [ ! -d /opt/ ]; then
	mkdir -p /opt/
fi
ln -s /nsm/bro/logs /var/log/bro


function install_packages()
{
Info "Installing Required .debs"
apt-get update && apt-get -y install cmake make gcc g++ flex bison libpcap-dev libssl-dev python-dev swig zlib1g-dev ssmtp htop vim libgeoip-dev ethtool git tshark tcpdump nmap mailutils python-pip autoconf libtool pkg-config libnacl-dev libncurses5-dev libnet1-dev libcli-dev libnetfilter-conntrack-dev liburcu-dev

	if [ $? -ne 0 ]; then
		Error "Error. Please check that apt-get can install needed packages."
		exit 2;
	fi
Info "Required -debs installed"
}


function config_net_ipv6()
{
Info "Disabling IPv6"
	if [ `grep 'net.ipv6.conf.all.disable_ipv6 = 1' /etc/sysctl.conf | wc -l` -eq 0 ] ; then
		echo "net.ipv6.conf.all.disable_ipv6 = 1" >> /etc/sysctl.conf
	fi
	if [ `grep 'ipv6.disable_ipv6=1' /boot/cmdline.txt | wc -l` -eq 0 ] ; then
		sed -i '1 s/$/ ipv6.disable_ipv6=1/' /boot/cmdline.txt
	fi
	Info "Sysctl"
	sysctl -p
}


function config_net_opts()
{
Info "Configuring network options"
	cd $_scriptDir
	cp nic.sh /etc/network/if-up.d/interface-tuneup
	chmod +x /etc/network/if-up.d/interface-tuneup
	ifconfig eth0 down && ifconfig eth0 up
}


function config_eth0()
{
Info "Configuring eth0"
cat >> /etc/dhcpcd.conf <<EOF

# IDSpi for promiscuous mode
static
interface eth0
static ip_address=0.0.0.0
EOF
}


function install_netsniff()
{
Info "Installing Netsniff-NG PCAP"
	touch /etc/netsniff
	apt-get -y install netsniff-ng
	cd $_scriptDir
	cp cleanup.sh /nsm/scripts/cleanup
	chmod +x /nsm/scripts/cleanup
}


function create_service_netsniff()
{
Info "Creating Netsniff-NG service"
echo "[Unit]
Description=Netsniff-NG PCAP
After=network.target

[Service]
ExecStart=/usr/sbin/netsniff-ng --in eth0 --out /nsm/pcap/ --bind-cpu 3 -s --interval 100MiB
Type=simple
EnvironmentFile=-/etc/netsniff

[Install]
WantedBy=multi-user.target" > /etc/systemd/system/netsniff-ng.service
	systemctl enable netsniff-ng
	systemctl daemon-reload
	service netsniff-ng start
}

# echo "Please enter your ntp server (leave blank for defaults)"
# read ntp_server

ntp_server = "hora.rediris.es"

function config_ntp()
{
if [ "${ntp_server}" == "" ]; then
	Info "No ntp server set, skipping."
else
	Info "Configuring NTP"
	sed -i.bak 's/^pool /# pool /' /etc/ntp.conf
	sed -i 's/^server /# server /' /etc/ntp.conf
	echo "## added by IDSpi:"  >> /etc/ntp.conf
	echo "server $ntp_server" >> /etc/ntp.conf
fi
}


function install_loki()
{
  Info "Installing YARA packages"
	Info "Installing PIP LOKI Packages"
		pip install psutil
		pip install yara-python
		pip install gitpython
		pip install pylzma
		pip install netaddr
	Info "Installing LOKI"
		git clone  https://github.com/Neo23x0/Loki.git /nsm/Loki
		git clone  https://github.com/Neo23x0/signature-base.git /nsm/Loki/signature-base/
		echo "export PATH=/nsm/Loki:$PATH" >> /etc/profile
		chmod +x /nsm/Loki/loki.py
		echo "export PYTHONPATH=$PYTHONPATH:/nsm/Loki" >> /etc/profile
echo "
#!/bin/sh
/usr/bin/python /nsm/Loki/loki.py --noprocscan --dontwait --onlyrelevant -p /nsm/bro/extracted -l /nsm/Loki/log
" \ > /nsm/scripts/scan
chmod +x /nsm/scripts/scan
}


function loki_update()
{

  echo "
  cd /nsm/Loki/
  python ./loki.py --update
  " \ > /nsm/scripts/update
  		sudo chmod +x /nsm/scripts/update

}


function install_bro()
{
Info "Installing Bro"
	apt-get -y install bro broctl bro-common bro-aux
}


install_packages
config_net_ipv6
config_net_opts
config_eth0
install_netsniff
create_service_netsniff
config_ntp
install_loki
loki_update
install_bro

echo "*/5 * * * * root /nsm/scripts/cleanup" >> /etc/crontab
echo "30 * * * *  root /nsm/scripts/update" >> /etc/crontab
