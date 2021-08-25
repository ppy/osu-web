#!/bin/sh

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_octane() {
  # exit on config update fail
  set -e

  /app/artisan config:cache
  /app/artisan route:cache

  /app/docker/deployment/entrypoint.sh config_reloader &
  /app/artisan octane:start --host=0.0.0.0 &
  OCTANE_PID=$!

  wait $OCTANE_PID

  echo "octane exit $?"

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
    /app/artisan octane:reload
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
    octane) _octane;;
    php) _php;;
    schedule) _schedule;;
    config_reloader) _config_reloader;;
    *) exec "$command" "$@";;
esac
