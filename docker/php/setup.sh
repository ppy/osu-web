#!/bin/bash

touch /usr/local/bin/yarn
chmod +x /usr/local/bin/yarn

groupadd -g $_gid osuweb
useradd -m -u $_uid -g $_gid osuweb
