#!/bin/bash
# Start Install Monitoring
sudo yum -y install monit
# Start Service
sudo systemctl start monit 
# Enable Service
sudo systemctl enable monit 
# Set Config Of Monitoring File
monitPath="/etc/monitrc"
backup="/etc/monitrc.bak"
newFilePath="config"
if [ -e $monitPath ]
    then 
        sudo cp $monitPath $backup
        sudo cp $newFilePath  $monitPath
        sudo chown root $monitPath
        sudo chgrp root $monitPath
        sudo chmod 600  $monitPath
        sudo systemctl restart monit 
else
    echo 'Monitoring Not Installed Yet\n'
fi
# Dispaly Status
status=$(sudo systemctl status monit | awk '/Active/ {print $2}')
if [[ $status == "active" ]]
        then echo "Monitoring Active And Listening On Your 0.0.0.0:81 with User:\"admin\" && password \"akram123456\""
else
        echo " Error Running Your Monitoring"
fi

