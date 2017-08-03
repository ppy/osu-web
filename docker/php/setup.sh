#!/bin/bash

touch /usr/local/bin/yarn
chmod +x /usr/local/bin/yarn

groupadd -g $_gid osuweb
useradd -u $_uid -g $_gid osuweb

mkdir /home/osuweb
chown osuweb:osuweb /home/osuweb
