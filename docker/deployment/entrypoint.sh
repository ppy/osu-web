#!/bin/sh

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_nginx() {
  # exit on config update fail
  set -e

  echo "starting nginx unit"

  # start NGINX Unit
  touch /home/osuweb/unit/unit.pid
  exec unitd \
    --control unix:/home/osuweb/unit/control.unit.sock \
    --pid /home/osuweb/unit/unit.pid \
    --state /home/osuweb/unit/state \
    --log /dev/stdout \
    --no-daemon &
  PID=$!

  echo "clearing laravel cache"

  /app/artisan config:cache
  /app/artisan route:cache

  # wait for NGINX Unit control socket to be open
  if [ ! -d /home/osuweb/unit/control.unit.sock ]; then
    echo "awaiting for nginx unit socket to be open"
    inotifywait -e create,open /home/osuweb/unit -t 2 || true
  fi

  echo "updating nginx unit config"
  # update config
  curl \
    -s \
    -X PUT \
    --data-binary @/app/docker/deployment/nginx-unit.json \
    --unix-socket /home/osuweb/unit/control.unit.sock \
    http://localhost/config 2>&1 > /dev/null

  echo "applying env vars"
  # update environment variables
  jq -n env | curl \
    -s \
    -X PUT \
    --data-binary @- \
    --unix-socket /home/osuweb/unit/control.unit.sock \
    http://localhost/config/applications/laravel/environment 2>&1 > /dev/null

  echo "spawning config reloader"
  /app/docker/deployment/entrypoint.sh config_reloader &
  CONFIG_RELOADER_PID=$!

  echo "init done"
  # keep running this script until NGINX Unit ends
  wait $PID

  echo "nginx exit $?"

  # kill child processes (config reloader)
  pkill -TERM -P $$
}

_config_reloader() {
  while true; do
    echo "Awaiting config update on .env..."
    inotifywait -e modify .env

    echo "Reloading config..."
    /app/artisan config:cache
    /app/artisan route:cache
  done
}

_php() {
    /app/artisan config:cache
    /app/artisan route:cache
    exec php-fpm8.0 -y /app/docker/deployment/php-fpm.conf
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
    config_reloader) _config_reloader;;
    *) exec "$command" "$@";;
esac
