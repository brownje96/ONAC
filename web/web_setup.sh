#!/bin/bash
apt update
apt upgrade -y
apt -y install lsb-release apt-transport-https ca-certificates apache2
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
apt-get install php7.3 php7.3-mysql -y
cp root/*.* /var/www/html

echo -n Enter your ONAC Database Server Host:
read onac_db_host

echo -n Enter your ONAC Database Password:
read -s onac_db_pass

sed -i "s/SERVER_HERE/$onac_db_host/" /var/www/html/community.php
sed -i "s/SERVER_HERE/$onac_db_host/" /var/www/html/post.php
sed -i "s/SERVER_HERE/$onac_db_host/" /var/www/html/profile.php

sed -i "s/PASSWORD_HERE/$onac_db_pass/" /var/www/html/community.php
sed -i "s/PASSWORD_HERE/$onac_db_pass/" /var/www/html/post.php
sed -i "s/PASSWORD_HERE/$onac_db_pass/" /var/www/html/profile.php

echo
echo Done.
