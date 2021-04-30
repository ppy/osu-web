#!/bin/sh

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_nginx() {
  # exit on config update fail
  set -e

  # start NGINX Unit
  touch /home/osuweb/unit/unit.pid
  exec unitd \
    --control unix:/home/osuweb/unit/control.unit.sock \
    --pid /home/osuweb/unit/unit.pid \
    --state /home/osuweb/unit/state \
    --log /dev/stdout \
    --no-daemon &
  PID=$!

  # wait for NGINX Unit control socket to be open
  inotifywait -e create,open /home/osuweb/unit

  # update config
  curl \
    -X PUT \
    --data-binary @/app/docker/deployment/nginx-unit.json \
    --unix-socket /home/osuweb/unit/control.unit.sock \
    http://localhost/config

  # update environment variables
  jq -n env | curl \
    -X PUT \
    --data-binary @- \
    --unix-socket /home/osuweb/unit/control.unit.sock \
    http://localhost/config/applications/laravel/environment

  # keep running this script until NGINX Unit ends
  wait $PID
}

_php() {
    /app/artisan config:cache
    /app/artisan route:cache
    exec php-fpm7.4 -y /app/docker/deployment/php-fpm.conf
}

_schedule() {
  while sleep 300; do
    exec /app/artisan schedule:run &
    echo 'Sleeping for 5 minutes'
  done
}

case "$command" in
    artisan) exec /app/artisan "$@";;
    nginx) _nginx;;
    php) _php;;
    schedule) _schedule;;
    *) exec "$command" "$@";;
esac
