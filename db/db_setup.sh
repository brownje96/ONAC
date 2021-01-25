#!/bin/bash
echo Make sure you are running as root
echo If you are on a VM, make sure you are not behind your virtualizer\'s NAT!!!
echo It is on you to assign a static IP address to this machine
read -n 1 -s -r -p "Press any key to continue"
apt-get install mariadb-server net-tools -y
sed -i 's/#port/port/' /etc/mysql/mariadb.conf.d/50-server.cnf
sed -i "s/127.0.0.1/$(hostname -I)/" /etc/mysql/mariadb.conf.d/50-server.cnf
mysql < onac.sql
clear
echo -n Enter your NEW ONAC DATABASE PASSWORD:
read -s onacpw
echo
echo -n Enter your NEW MariaDB ROOT PASSWORD:
read -s dbrootpw
echo
echo CREATE USER \'onac\'@\'%\' IDENTIFIED BY \'$onacpw\' | mysql
echo "GRANT ALL ON onac.* TO 'onac'@'%';" | mysql
echo ALTER USER \'root\'@\'localhost\' IDENTIFIED BY \'$dbrootpw\' | mysql
clear
echo You are done setting up the database server for ONAC.
echo DO NOT CLEAR YOUR SCREEN - YOU MAY NEED TO COPY THIS INFORMATION
echo
echo When prompted on the WEB SETUP SCRIPT, enter the following values:
echo
echo Database Server Hostname: $(hostname -I)
echo Database Server Username: onac
echo Database Server Password: $onacpw
echo Database: onac
echo
echo Once you\'ve installed the web server, you may need to reboot
echo this database server to finalize all settings.
