#!/bin/sh

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_php() {
    /app/artisan config:cache
    /app/artisan lighthouse:cache
    /app/artisan route:cache
    exec php-fpm8.0 -y /app/docker/deployment/php-fpm.conf
}

case "$command" in
    artisan) exec /app/artisan "$@";;
    assets) exec nginx -c /app/docker/deployment/nginx-assets.conf "$@";;
    php) _php;;
    *) exec "$command" "$@";;
esac
