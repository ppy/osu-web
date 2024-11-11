#!/bin/sh

uid=$(stat -c "%u" /app)
gid=$(stat -c "%g" /app)

if [ "$uid" != 0 ]; then
    usermod -u "$uid" -o osuweb > /dev/null
    groupmod -g "$gid" -o osuweb > /dev/null
fi

chown -f "${uid}:${gid}" .docker/js-build/assets .docker/js-build/builds

exec gosu osuweb /app/docker/development/run.sh "$@"
