#!/bin/bash

userdel node

groupadd -g $_gid osuweb
useradd -m -u $_uid -g $_gid osuweb

npm install -g yarn
