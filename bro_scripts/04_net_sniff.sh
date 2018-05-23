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


install_netsniff
create_service_netsniff
