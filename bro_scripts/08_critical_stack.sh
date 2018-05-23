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


echo "Please enter your Critical Stack API Key (sensor): "
read api

# api 57622caa-733e-44e2-6855-97211e91dd79


function install_criticalstack()
{
Info "Installing Critical Stack Agent"
	wget  --no-check-certificate https://intel.criticalstack.com/client/critical-stack-intel-arm.deb
	dpkg -i critical-stack-intel-arm.deb
		chown critical-stack:critical-stack /usr/share/bro/site/local.bro
		sudo -u critical-stack critical-stack-intel config --set bro.path=/usr/bin/bro
		sudo -u critical-stack critical-stack-intel config --set bro.include.path=/usr/share/bro/site/local.bro
		sudo -u critical-stack critical-stack-intel config --set bro.broctl.path=/usr/bin/broctl
		sudo -u critical-stack critical-stack-intel api $api
		sudo -u critical-stack critical-stack-intel list
		sudo -u critical-stack critical-stack-intel pull
		#Deploy and start BroIDS
		export PATH="/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/usr/local/bro/bin:\$PATH"
	echo "Deploying and starting BroIDS"
		broctl deploy
		broctl cron enable
		#Create update script
echo "
echo \"#### Pulling feed update ####\"
sudo -u critical-stack critical-stack-intel pull
sudo systemctl restart bro-idspi
cd /nsm/Loki/
python ./loki.py --update
" \ > /nsm/scripts/update
		sudo chmod +x /nsm/scripts/update
}


install_criticalstack
