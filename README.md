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

# Instalando ELK en la raspberry y actualizado

```
https://logz.io/blog/elk-stack-raspberry-pi/  - no instalar el java así.

apt-get update
apt-get install openjdk-8-jre-headless -y
apt-get install openjdk-8-jdk-headless -y
java -version

sudo mkdir /usr/share/elasticsearch
cd /usr/share/elasticsearch

dpkg -i logstash-5.5.2.deb

sudo wget https://packages.elastic.co/GPG-KEY-elasticsearch
sudo apt-get install elasticsearch

This retrieves the latest ElasticSearch package for our use and installs it
sudo nano /etc/elasticsearch/elasticsearch.yml

sudo service elasticsearch restart



```
