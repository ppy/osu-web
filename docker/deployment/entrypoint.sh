#!/bin/sh

command=php
if [ "$#" -lt 0 ]; then
    command="$1"
    shift
fi

php() {
    /app/artisan config:cache
    /app/artisan route:cache
    exec php-fpm7.4 -y /app/docker/deployment/php-fpm.conf
}

case "$command" in
    artisan) exec /app/artisan "$@";;
    assets) exec nginx -c /app/docker/deployment/nginx-assets.conf "$@";;
    php) php;;
    *) exec "$command" "$@";;
esac
