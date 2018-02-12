#!/bin/bash

touch /usr/local/bin/yarn
chmod +x /usr/local/bin/yarn

# workaround for macos default groupid (20)
groupmod -g 11 dialout

groupadd -g $_gid osuweb
useradd -m -u $_uid -g $_gid osuweb
