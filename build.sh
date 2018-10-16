#!/bin/sh

set -u
set -e

# The user when provisioning is different than the user running actual php workers (in production).
if [ -z "${OSU_SKIP_CACHE_PERMISSION_OVERRIDE:-}" ]; then
    # Don't fail if permissions don't get set on all files.
    chmod -R 777 storage bootstrap/cache || true
fi

if [ ! -d node_modules ]; then
  mkdir -p ~/node_modules
  ln -snf ~/node_modules node_modules
fi

if [ -f composer.phar ]; then
  php composer.phar self-update
else
  curl -sL https://getcomposer.org/installer > composer-installer
  php composer-installer
fi

# dummy user, no privilege github token to avoid github api limit
php composer.phar config -g github-oauth.github.com 98cbc568911ef1e060a3a31623f2c80c1786d5ff

rm -f bootstrap/cache/*.php bootstrap/cache/*.json

php composer.phar install

php artisan view:clear

# e.g. OSU_SKIP_DB_MIGRATION=1 ./build.sh to bypass running migrations
if [ -z "${OSU_SKIP_DB_MIGRATION:-}" ]; then
  php artisan migrate --force
fi

php artisan passport:keys
php artisan lang:js resources/assets/js/messages.js
php artisan laroute:generate

if [ ! "${APP_DEBUG:-false}" = "true" ]
then
  php artisan config:cache
  php artisan route:cache
fi

command -v yarn || npm install -g yarn
yarn
yarn run production
