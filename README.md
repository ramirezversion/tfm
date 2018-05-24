# Sobreviviendo a Laravel

```
sudo apt-get update
sudo apt-get upgrade

apt-get update
apt-get install apache2
apt-get install mysql-server

For Raspbian
In the file sudo nano /etc/apt/sources.list at the end we add:
deb http://mirrordirector.raspbian.org/raspbian/ buster main contrib non-free rpi

apt-get install php7.1 php7.1-mcrypt php7.1-xml php7.1-gd php7.1-opcache php7.1-mbstring php7.1-mysql
sudo apt-get install libapache2-mod-php7.1
```

## Instalar phpmyadmin

```
sudo apt-get install phpmyadmin
sudo apt-get install php7.1-mbstring php-gettext
sudo phpenmod mcrypt
sudo phpenmod mbstring
sudo systemctl restart apache2


sudo a2enmod ssl
sudo a2enmod rewrite

```

## Instalar nodejs

````
curl -sL https://deb.nodesource.com/setup_9.x | bash -
apt-get install -y nodejs
````

En la carpeta de proyecto

````
npm install
npm run dev
npm run watch
````

## Instalar LaravelCollective

```
composer require "laravelcollective/html":"^5.4.0"
```

## Crear un controlador

```
php artisan make:controller MessagesController
```



## Problemas con el login en phpmyadmin con root

```
sudo mysql --user=root mysql

CREATE USER 'phpmyadmin'@'localhost' IDENTIFIED BY 'some_pass';
GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

Using sudo, edit /etc/dbconfig-common/phpmyadmin.conf

```
# dbc_dbuser: database user
#       the name of the user who we will use to connect to the database.
dbc_dbuser='phpmyadmin'

# dbc_dbpass: database user password
#       the password to use with the above username when connecting
#       to a database, if one is required
dbc_dbpass='some_pass'
```

## Crear tablas y modelos para la base de datos

```
php artisan make:model Message -m
```

Con el `-m` se crea también el migrate. Rellenas el campo migrations con lo que necesitas y ejecutas la migración.

```
php artisan migrate
```

```
php artisan migrate:refresh --seed
```

-

# Instalando ELK en la raspberry y actualizado pero no va fino. Se separa en dos.

```
https://thesecuritystoic.com/2017/08/home-security-iii-elk-on-a-raspberry-pi/


apt-get update
apt-get install openjdk-8-jre-headless -y
apt-get install openjdk-8-jdk-headless -y
java -version



Download the ElasticSearch Debian package from their website, and install. For this tutorial we use the 5.5.2 version.

$ sudo wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.5.2.deb
$ sudo dpkg -i elasticsearch-5.5.2.deb
1.3 Edit the file /etc/elasticsearch/elasticsearch.yml and uncomment and modify the cluster.name, network.host and http.port settings as follows:

$ sudo nano /etc/elasticsearch/elasticsearch.yml
cluster.name: (Whatever name you want)
network.host: 127.0.0.1
http.port: 9200
1.4 Start it up

$ sudo service elasticsearch start
1.5 Check if it started

$ sudo service elasticsearch status
1.6 If failed with an error ‘Could not reserve enough space for XXXKB object heap’, go to /etc/elasticsearch, open jvm.options and edit the following two lines:

-Xms2g change to -> -Xms200m
-Xmx2g change to -> -Xms500m
Then start elasticsearch again :

$ sudo service elasticsearch restart
It should now say active (running). That’s one down, two to go!



Logstash
Logstash will be our data processing application that can put all of our data into ElasticSearch for searching and analytics. It is essentially a big pipeline that takes input from different sources and transforms it for ElasticSearch.

1.1 We want to download the latest logstash debian package from the Elastic website and install it. For this tutorial we use the 5.5.2 version.

$ sudo wget https://artifacts.elastic.co/downloads/logstash/logstash-5.5.2.deb
$ sudo dpkg -i logstash-5.5.2.deb


1.2 We also need to setup the JFFI code for our ARM chip:

$ sudo apt-get install ant
$ sudo git clone https://github.com/jnr/jffi.git
$ cd jffi
$ sudo ant jar
$ sudo cp build/jni/libjffi-1.2.so /usr/share/logstash/vendor/jruby/lib/jni/arm-Linux
(when the .so file is not generated, delete the complete jffi folder and reinstall again)
$ cd /usr/share/logstash/vendor/jruby/lib
$ sudo zip -g jruby-complete-1.7.11.jar jni/arm-Linux/libjffi-1.2.so


1.3 We want to do the same as with Elasticsearch, by starting the service and checking the status

$ sudo service logstash start
$ sudo service logstash status

1.4 The output of the last command should say active (running), I have not encountered any errors in my installation. If they do occur, try to google the errorcode to see what you can do to fix it.

Kibana
1.1 First, we need to download the kibana package we need. For this tutorial we use the Linux 32-Bit 5.5.2 version.

$ sudo wget https://artifacts.elastic.co/downloads/kibana/kibana-5.5.2-linux-x86.tar.gz
1.2 Untar the downloaded file

$ sudo tar –xzf kibana-5.5.2-linux-x86.tar.gz
1.3 Move the untared files to the kibana directory

$ sudo mkdir /opt/kibana/
$ sudo mv kibana-5.5.2-linux-x86/ /opt/kibana/
1.4 Now, we need to make the kibana package compatible with the ARM chip we have on the Raspberry Pi, as the standard Kibana package is made for Intel chips. We can do this by installing the latest ARM nodejs version:

$ sudo wget https://nodejs.org/download/release/v6.10.2/node-v6.10.2-linux-armv6l.tar.gz
$ tar -xzf node-v6.10.2-linux-armv6l.tar.gz
1.5 Now that we have the nodejs files untarred, we need to make sure they replace our current node files. We can do this as follows:

$ sudo cp node-v6.10.2-linux-armv6l/bin/node /usr/local/bin/node
$ sudo cp node-v6.10.2-linux-armv6l/bin/npm /usr/local/bin/npm
1.6 Now we need to make our new ARM node files linked to the node files kibana uses. We first need to backup the original kibana node/npm files and then link them, as follows:

$ sudo mv /opt/kibana/node/bin/node /opt/kibana/node/bin/node.orig
$ sudo mv /opt/kibana/node/bin/npm /opt/kibana/node/bin/npm.orig
$ sudo ln -s /usr/local/bin/node /opt/kibana/node/bin/node
$ sudo ln -s /usr/local/bin/npm /opt/kibana/node/bin/npm


1.7 Before we start kibana, we have to make sure it uses the right settings.

$ sudo nano /opt/kibana/config/kibana.yml
Uncomment and edit the following lines in the file:

server.host: "127.0.0.1"
elasticsearch.url: http://127.0.0.1:9200
Remove the # at the front of the server.port setting found at the top of the file
1.8 Next, we need to add Kibana to our systemd folder.

$ sudo nano /etc/systemd/system/kibana.service
And add the following lines:

[Unit]
Description=Kibana

[Service]
ExecStart=/opt/kibana/bin/kibana
StandardOutput=null

[Install]
WantedBy=multi-user.target

1.9 Now, we can start kibana and check its status

$ sudo service kibana start
$ sudo service kibana status


```

# Se separa ELK y se deja logstash solo en la raspberry para en envío de logs y ElasticSearch y Kibana en un server con más potencia

La instalación del servidor se hace así
https://linuxconfig.org/install-elk-on-ubuntu-18-04-bionic-beaver-linux


instalar filebeat en la Raspberry
```
https://github.com/dam90/pibeats/blob/master/build_script.sh
http://ict.renevdmark.nl/2016/07/05/elastic-beats-on-raspberry-pi/
```

Crea el servicio // no va fino filipino
```
pi@raspberrypi:/opt/filebeat $ sudo cat usr/lib/systemd/system/filebeat.service
[Unit]
Description=filebeat
Documentation=https://www.elastic.co/guide/en/beats/filebeat/current/index.html
Wants=userwork-online.target
After=network-online.target

[Service]
ExecStart=/opt/filebeat/filebeat -c /opt/filebeat/filebeat.yml -path.home /opt/filebeat -path.config /opt/filebeat -path.data /opt/filebeat -path.logs /opt/filebeat
Restart=always

[Install]
WantedBy=multi-user.target
```

```
sudo chown -R root:root /opt/filebeat/*
```


y luego `sudo systemctl enable filebeat` y `sudo systemctl start filebeat`


El fichero de configuración y el modules

```
#=========================== Filebeat prospectors =============================
filebeat.prospectors:
- type: log

  # Change to true to enable this prospector configuration.
  enabled: true

  # Paths that should be crawled and fetched. Glob based paths.
  paths:
    - /var/log/*.log
    - /var/log/auth.log
    - /var/log/syslog
    - /var/log/apache2/*
    - /var/log/mysql*

  #document-type: syslog


#============================= Filebeat modules ===============================

filebeat.config.modules:
  # Glob pattern for configuration loading
  enable: true
  path: /opt/filebeat/modules.d/*.yml

  # Set to true to enable config reloading
#  reload.enabled: false

  # Period on which files under path should be checked for changes
  #reload.period: 10s


#============================== Kibana =====================================

# Starting with Beats version 6.0.0, the dashboards are loaded via the Kibana API.
# This requires a Kibana endpoint configuration.
setup.kibana:

  # Kibana Host
  # Scheme and port can be left out and will be set to the default (http and 5601)
  # In case you specify and additional path, the scheme is required: http://localhost:5601/path
  # IPv6 addresses should always be defined as: https://[2001:db8::1]:5601
  host: "kibana.zero:80"


#================================ Outputs =====================================

# Configure what outputs to use when sending the data collected by the beat
#-------------------------- Elasticsearch output ------------------------------
output.elasticsearch:
  hosts: "kibana.zero:9200"
#  index: "pibeat-%{+yyyy.MM.dd}"

#================================ Logging =====================================

#logging.to_files: true
#logging.to_syslog: false
```

```
- module: system
  # Syslog
  syslog:
    enabled: true

    # Set custom paths for the log files. If left empty,
    # Filebeat will choose the paths depending on your OS.
    var.paths: ["/var/log/syslog*"]

    # Convert the timestamp to UTC. Requires Elasticsearch >= 6.1.
    #var.convert_timezone: false

  # Authorization logs
  auth:
    enabled: true

    # Set custom paths for the log files. If left empty,
    # Filebeat will choose the paths depending on your OS.
    #var.paths:

    # Convert the timestamp to UTC. Requires Elasticsearch >= 6.1.
    #var.convert_timezone: false
```

si haces un filebeat setup se instala en kibana todo el pack de dashboard y demás.


en el ElasticSearch
```
sudo /usr/share/elasticsearch/bin/elasticsearch-plugin install ingest-geoip

sudo /usr/share/elasticsearch/bin/elasticsearch-plugin install ingest-user-agent
```



En el broctl.cfg añadir esto para que saque los logs en json

### Added for json log output
broargs=-e 'redef LogAscii::use_json=T;'
