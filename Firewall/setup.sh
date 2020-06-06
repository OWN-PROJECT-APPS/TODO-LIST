#!/bin/bash
# Install Firewall 
echo "Start Firewall Installation And Configuration. \n"
sudo yum -y install firewalld
# Run The Service Of Firewall
sudo systemctl start firewalld
# Enable The Service For Start When We Start The System
sudo systemctl enable firewalld
#Give Access The Port 80 From Outside
sudo firewall-cmd --permanent --zone=public --add-service=http 
sudo firewall-cmd --permanent --zone=public --add-service=https
sudo firewall-cmd --permanent --zone=public --add-port=81/tcp
sudo firewall-cmd --permanent --zone=public --add-port=22/tcp
# Restart The Service We Give An Access For Specific Port
sudo firewall-cmd --reload
# Read Status
status=$(sudo systemctl status firewalld | awk '/Active/ {print $2}')
if [[ $status == "active" ]]
        then echo "firewall is Running"
else
        echo "Error Running firewall Service"
fi


