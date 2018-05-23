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


install_loki
