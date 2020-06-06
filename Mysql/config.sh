#!/bin/bash
# Installing Mysql Server
echo "Start Installation anad Configuration Mysql Server .\n"
./setup.sh
# Start MySQL Service
sudo systemctl start mysqld
# Enable Mysql Service Ehen We Started Our System
systemctl enable mysqld
# Dispaly Status OF Mysql Server
status=$(sudo systemctl status mysqld | awk '/Active/ {print $2}')
if [[ $status == "active" ]]
    then echo "Mysql Started Successfully\n"
    # Show the default password for root user
    defaultPass=$(sudo awk '/temporary password/ {print $NF}' /var/log/mysqld.log)
    echo "Default Password Is : $defaultPass"
    # Configuring MySQL
    # MySQL Secure Installation
    mysql_secure_installation
    echo 'Add The Password Of Database In Project File "project/database/config.php" $pass = "Here"\n'
    # Restart and enable the MySQL service
    systemctl restart mysqld
    # Some Helper
    echo 'Please Create Database "todos"  \n'
    #Connect to MySQL
    database='todos'
    pathOfFile='./todos.sql'
    read  -p 'Did You Created The Database ( todos ) Y|N : ' res

    if [[ res == 'Y' ]];then
        mysql -u root  $database < $pathOfFile -p
        echo "Done !"
    # Create Database TODOS
    else
        echo "Please Create Database ( todos ) \n"
    fi
else
    echo "Error Start Mysql May Be Has A conflicts Between mysql-community-release.\n"
    echo "Please Verify RPM Files Via \"rpm -qa | grep mysql\" Then Remove Conflict Through \"rpm -e mysql*\""
    echo "Then Restart config.sh File Of Mysql\n"
fi
