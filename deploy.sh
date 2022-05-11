#!/bin/sh

set -u
set -e

outdir="/deploy/osu-web-$(date "+%Y%m%dT%H%M%S")"

mkdir -p "$outdir"
cp -pr ./ "$outdir"

ln -snf "$outdir" "/deploy/current"

cd "$outdir"

# if debug is enabled
if [ ! "${APP_DEBUG:-false}" = "true" ]
then
  php artisan config:cache
  php artisan route:cache
fi
