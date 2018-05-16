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
https://logz.io/blog/elk-stack-raspberry-pi/
sudo apt-get install default-jre

sudo mkdir /usr/share/elasticsearch
cd /usr/share/elasticsearch
sudo wget https://packages.elastic.co/GPG-KEY-elasticsearch
sudo apt-get install elasticsearch

This retrieves the latest ElasticSearch package for our use and installs it
sudo nano /etc/elasticsearch/elasticsearch.yml

sudo service elasticsearch restart



-- Así no funciona
sudo apt-get install apt-transport-https
echo “deb https://artifacts.elastic.co/packages/5.x/apt stable main” | sudo tee -a /etc/apt/sources.list.d/elastic-5.x.list
wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
sudo apt-get update
sudo apt-get install logstash
sudo service logstash start


--
sudo apt-get install oracle-java8-jdk

$ sudo wget https://artifacts.elastic.co/downloads/logstash/logstash-5.5.2.deb
$ sudo dpkg -i logstash-5.5.2.deb

$ sudo apt-get install ant
$ sudo git clone https://github.com/jnr/jffi.git
$ cd jffi
$ sudo ant jar
$ cp build/jni/libjffi-1.2.so /usr/share/logstash/vendor/jruby/lib/jni/arm-Linux
(when the .so file is not generated, delete the complete jffi folder and reinstall again)
$ cd /usr/share/logstash/vendor/jruby/lib
$ sudo zip -g jruby-complete-1.7.11.jar jni/arm-Linux/libjffi-1.2.so

```
