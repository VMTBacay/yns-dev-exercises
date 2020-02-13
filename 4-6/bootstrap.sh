#!/usr/bin/env bash

yum -y update
yum -y install httpd
yum -y install epel-release yum-utils
yum -y install http://rpms.remirepo.net/enterprise/remi-release-6.rpm
yum-config-manager --enable remi-php73
yum -y install php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlnd	
wget https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
rpm -ivh mysql57-community-release-el7-9.noarch.rpm
yum -y install mysql-server
yum -y install phpmyadmin
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi