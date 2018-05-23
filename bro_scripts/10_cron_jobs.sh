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


#CRON JOBS
echo "0,5,10,15,20,25,35,40,45,50,55 * * * * root /usr/bin/broctl cron" >> /etc/crontab
echo "*/5 * * * * root /nsm/scripts/cleanup" >> /etc/crontab
echo "30 * * * *  root /nsm/scripts/update" >> /etc/crontab
#echo "*/5 * * * * root python /nsm/scripts/scan" >> /etc/crontab
