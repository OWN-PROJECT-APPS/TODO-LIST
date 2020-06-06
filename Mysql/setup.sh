#!/bin/bash
repo="https://dev.mysql.com/get/mysql80-community-release-el7-3.noarch.rpm"
file="mysql80-community-release-el7-3.noarch.rpm"
# Before All Thing We Have To Install Wget Package
sudo yum -y install wget
#  Create rpm File
sudo wget $repo
# Verified that the file wasn’t corrupted or changed
sudo rpm -Uvh $file
# Install MySQL 8 Community Server
sudo yum -y install mysql-server

