#!/bin/sh

# setup repositories
apt-get update

apt-get install -y --force-yes software-properties-common

sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
sudo add-apt-repository 'deb http://dl.hhvm.com/ubuntu vivid main'

apt-get update
# install needed tools and daemons
export DEBIAN_FRONTEND=noninteractive

apt-get install curl wget git nginx nodejs npm redis-server hhvm screen vim percona-server-server-5.6 -y --force-yes
update-rc.d hhvm defaults
ln -s /usr/bin/nodejs /usr/bin/node

rm /etc/nginx/sites-enabled/default
ln -s /vagrant/conf/nginx-osu-next /etc/nginx/sites-available/nginx-osu-next
ln -s /etc/nginx/sites-available/nginx-osu-next /etc/nginx/sites-enabled/nginx-osu-next

cd /data/osu\!web/

for db in osu osu_store; do
  echo "CREATE DATABASE ${db} DEFAULT CHARSET utf8mb4" | mysql -u root
  for dumptype in structure data; do
    file="db-${db}-${dumptype}.sql"
    test -f "${file}" || continue
    mysql -u root "${db}" < "${file}"
  done
done

# replace mysql config vars to be reachable from vm host
sed -i 's/bind-address/#bind-address/' /etc/mysql/my.cnf

sed -i '$a hhvm.http.slowquerytreshold = 60000' /etc/hhvm/server.ini

#this shouldn't be applied to live servers, but is required for a shitty virtualbox bug (https://www.virtualbox.org/ticket/9069)
sed -i 's/sendfile on/sendfile off/' /etc/nginx/nginx.conf

service mysql restart
service hhvm restart
service nginx restart

echo "Finished setup of daemons and servers"
