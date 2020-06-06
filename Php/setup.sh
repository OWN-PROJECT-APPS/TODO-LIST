#!/bin/bash
#Enabling Remi repository
sudo yum -y install epel-release yum-utils
sudo yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
#Installing PHP 7.3 
sudo yum-config-manager --enable remi-php73
sudo yum -y install php php-common php-mysql php-opcache php-mcrypt php-cli php-gd php-curl php-mysqlnd
#Configuring PHP 7.x to work with Apache
sudo systemctl restart apache2
