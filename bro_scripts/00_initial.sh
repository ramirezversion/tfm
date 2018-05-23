#!/usr/bin/env bash
_scriptDir="$(dirname `readlink -f $0`)"

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

install_packages
