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


echo "Please enter your ntp server (leave blank for defaults)"
read ntp_server

# ntp_server = "hora.rediris.es"

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


config_ntp
