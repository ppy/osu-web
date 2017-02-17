apt-key adv --keyserver keys.gnupg.net --recv 5072E1F5
echo mysql-apt-config mysql-apt-config/select-server select mysql-5.7 | debconf-set-selections
wget https://dev.mysql.com/get/mysql-apt-config_0.7.3-1_all.deb
dpkg --install mysql-apt-config_0.7.3-1_all.deb
apt-get update -q
apt-get install -q -y -o Dpkg::Options::=--force-confnew mysql-server
mysql_upgrade
