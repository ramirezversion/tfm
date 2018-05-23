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


function install_bro()
{
Info "Installing Bro"
	apt-get -y install bro broctl bro-common bro-aux
}

function create_bro_service(){
  Info "Creating Bro service"
  echo "[Unit]
  Description=Bro IDSpi Service
  After=network.target

  [Service]
  ExecStart=sudo bro -i eth0 -e 'redef LogAscii::use_json=T;'
  Type=simple
  EnvironmentFile=-/etc/netsniff

  [Install]
  WantedBy=multi-user.target" > /etc/systemd/system/bro-idspi.service

    systemctl enable bro-idspi
  	systemctl daemon-reload
  	service bro-idspi start
}

install_bro
create_bro_service
