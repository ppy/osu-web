#!/bin/sh

# exit on any failure
set -e
# exit on unassigned variable
set -u

command=php
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

_octane() {
  /app/artisan config:cache
  /app/artisan route:cache

  exec /app/artisan octane:start --host=0.0.0.0 "$@"
}

case "$command" in
    artisan) exec /app/artisan "$@";;
    assets) exec nginx -c /app/docker/deployment/nginx-assets.conf "$@";;
    octane) _octane "$@";;
    *) exec "$command" "$@";;
esac
