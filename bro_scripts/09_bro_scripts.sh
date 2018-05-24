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

function install_bro_reporting()
{
Info "Bro Reporting Requirements"
	pip install colorama
#PYSUBNETREE
	pip install pysubnettree
#IPSUMDUMP
	cd /opt/
	wget http://www.read.seas.harvard.edu/~kohler/ipsumdump/ipsumdump-1.85.tar.gz
	tar -zxvf ipsumdump-1.85.tar.gz
	cd ipsumdump-1.85/
	./configure && make && make install
}


function config_bro_scripts()
{
Info "Configuring BRO scripts"
	#PULL BRO SCRIPTS
	cd /usr/share/bro/site/
	if [ -d /usr/share/bro/site/bro-scripts/ ]; then
		rm -rf /usr/share/bro/site/bro-scripts/
	fi
	mkdir -p /usr/share/bro/site/bro-scripts
	git clone https://github.com/sneakymonk3y/bro-scripts.git
	echo "@load bro-scripts/geoip"  >> /usr/share/bro/site/local.bro
	echo "@load bro-scripts/extract"  >> /usr/share/bro/site/local.bro
	broctl deploy
}

install_bro_reporting
config_bro_scripts
