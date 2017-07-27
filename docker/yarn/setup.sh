#!/bin/bash

userdel node

groupadd -g $_gid osuweb
useradd -u $_uid -g $_gid osuweb

mkdir /home/osuweb
chown osuweb:osuweb /home/osuweb

npm install -g yarn
