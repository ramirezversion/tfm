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

function install_geoip()
{
Info "Installing GEO-IP"
	wget  http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz
	wget  http://geolite.maxmind.com/download/geoip/database/GeoLiteCityv6-beta/GeoLiteCityv6.dat.gz
	gunzip GeoLiteCity.dat.gz
	gunzip GeoLiteCityv6.dat.gz
	mv GeoLiteCity* /usr/share/GeoIP/
	ln -s /usr/share/GeoIP/GeoLiteCity.dat /usr/share/GeoIP/GeoIPCity.dat
	ln -s /usr/share/GeoIP/GeoLiteCityv6.dat /usr/share/GeoIP/GeoIPCityv6.dat
}

install_geoip
