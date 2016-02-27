#!/bin/sh

# setup repositories
apt-get update -q

apt-get install \
    curl \
    software-properties-common \
    -q -y --force-yes

add-apt-repository -y ppa:ondrej/php

_release="$(lsb_release -cs)"
apt-key adv --keyserver hkp://pgp.mit.edu:80 --recv-keys 5072E1F5
add-apt-repository "deb http://repo.mysql.com/apt/ubuntu/ ${_release} mysql-5.7"

curl -sL https://deb.nodesource.com/setup_4.x > setup-nodejs && bash setup-nodejs
rm -f setup-nodejs

apt-get update
# install needed tools and daemons
export DEBIAN_FRONTEND=noninteractive

apt-get install \
    git \
    mysql-server-5.7 \
    nginx \
    nodejs \
    php7.0-curl \
    php7.0-fpm \
    php7.0-gd \
    php7.0-json \
    php7.0-mcrypt \
    php7.0-mysql \
    redis-server \
    tmux \
    vim \
    wget \
    -q -y --force-yes

update-rc.d php7.0-fpm defaults

rm /etc/nginx/sites-enabled/default
ln -s /vagrant/conf/nginx-osu-next /etc/nginx/sites-available/nginx-osu-next
ln -s /etc/nginx/sites-available/nginx-osu-next /etc/nginx/sites-enabled/nginx-osu-next

cd /data/osu\!web/

mkdir -p "public/uploads"
chmod 777 "public/uploads"

# replace mysql config vars to be reachable from vm host
sed -i 's/bind-address/#bind-address/' /etc/mysql/my.cnf

#this shouldn't be applied to live servers, but is required for a shitty virtualbox bug (https://www.virtualbox.org/ticket/9069)
sed -i 's/sendfile on/sendfile off/' /etc/nginx/nginx.conf

service mysql restart
service php7.0-fpm restart
service nginx restart

./bin/db_setup

echo "Finished setup of daemons and servers"
