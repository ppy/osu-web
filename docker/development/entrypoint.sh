#!/bin/sh

uid=$(stat -c "%u" .)
gid=$(stat -c "%g" .)

if [ "$uid" != 0 ]; then
    usermod -u "$uid" -o osuweb > /dev/null
    groupmod -g "$gid" -o osuweb > /dev/null
fi

chown -f "${uid}:${gid}" ./storage/testjs-*

exec gosu osuweb ./docker/development/run.sh "$@"
