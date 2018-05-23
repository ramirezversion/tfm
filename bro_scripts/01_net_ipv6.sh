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

config_net_ipv6
