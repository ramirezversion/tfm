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

config_eth0
