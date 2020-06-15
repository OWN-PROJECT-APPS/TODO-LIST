#!/bin/bash
# Update System
sudo yum -y update
# Start Nginx Installation And Configuration
./Apache/setup.sh
# Start Install PHP
./Php/setup.sh
# Start Install SSH Service
./Ssh/setup.sh
# Start Firewall Installation And Configuration
./Firewall/setup.sh
# start Mysql Installation And Configuration
./Mysql/config
echo "Configuration Of the network.\n"
read -p  "Please Choose Interface For Your Network :(enp0s8 | ens33 | ..) " interface
ipadd=$(ip addr show $interface | grep inet | awk '{ print $2; }' | sed 's/\/.*$//')
echo "Nginx listening On ${ipadd}:80\n"
echo "Your Home Directory That Apache listening Is In : /var/www/html \n"
# Add All Service To Monitoring
./Monitoring/setup.sh