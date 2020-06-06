#!/bin/bash
# Install Apache HTTP SERVER
# Install Apache
echo "Start Installation Apache.\n"
sudo yum -y install httpd
echo "End Installing Apache.\n"
# End Installaion Apache
# Start Apache
sudo systemctl start httpd
# Enable Apache To Run When We Started Our System
sudo systemctl enable httpd
# Read Status
status=$(sudo systemctl status httpd | awk '/Active/ {print $2}')
if [[ $status == "active" ]]
        then echo "Apache is Running And Listening On Your 0.0.0.0:80"
else
        echo "Error Running Apache Service"
fi


