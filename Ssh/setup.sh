#!/bin/bash
#Start Install SSH Service
echo "Start Install SSH Server"
sudo yum -y install openssh-server
# start Running The Service
sudo systemctl start sshd
# Read Status
status=$(sudo systemctl status sshd | awk '/Active/ {print $2}')
if [[ $status == "active" ]]
        then echo "SSH Active And Listening On Your 0.0.0.0:22"
else
        echo "Error Running SSH Service"
fi

