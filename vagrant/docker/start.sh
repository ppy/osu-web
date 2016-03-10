#!/bin/sh

serviceCommand() {
  if sudo service --status-all | grep -Fq ${1}; then
    sudo service ${1} ${2}
  fi
}

serviceCommand mysql restart
serviceCommand php7.0-fpm restart
serviceCommand nginx restart

/usr/sbin/sshd -D
