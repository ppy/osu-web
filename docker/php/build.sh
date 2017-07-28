#!/bin/sh

set -u
set -e

cp .env.example .env

# the user when provisioning is `osuweb`, but files are created by `www-data`
# don't fail if permissions don't get set on all files (useful when reloading the container)
chmod -R 777 storage bootstrap/cache || true

curl -sL https://getcomposer.org/installer > composer-installer
php composer-installer

# dummy user, no privilege github token to avoid github api limit
php composer.phar config -g github-oauth.github.com 98cbc568911ef1e060a3a31623f2c80c1786d5ff

rm -f bootstrap/cache/*.php bootstrap/cache/*.json

php composer.phar install

php artisan view:clear

# e.g. OSU_SKIP_DB_MIGRATION=1 ./build.sh to bypass running migrations
if [ -z "${OSU_SKIP_DB_MIGRATION:-}" ]; then
  php artisan migrate --force
fi

php artisan lang:js resources/assets/js/messages.js
php artisan laroute:generate
