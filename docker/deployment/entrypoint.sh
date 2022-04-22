#!/bin/sh

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_octane() {
  # exit on any failure
  set -e

  /app/artisan config:cache
  /app/artisan route:cache

  /app/artisan octane:start --host=0.0.0.0
}

_php() {
    /app/artisan config:cache
    /app/artisan route:cache
    exec php-fpm8.0 -y /app/docker/deployment/php-fpm.conf
}

_schedule() {
  /app/artisan schedule:run
}

case "$command" in
    artisan) exec /app/artisan "$@";;
    assets) exec nginx -c /app/docker/deployment/nginx-assets.conf "$@";;
    octane) _octane;;
    php) _php;;
    schedule) _schedule;;
    *) exec "$command" "$@";;
esac
