#!/bin/sh

set -u
set -e

# The user when provisioning is different than the user running actual php workers (in production).
if [ -z "${OSU_SKIP_CACHE_PERMISSION_OVERRIDE:-}" ]; then
    # Don't fail if permissions don't get set on all files.
    chmod -R 777 storage bootstrap/cache || true
fi

if [ -f composer.phar ]; then
  php composer.phar self-update --1
else
  curl -sL https://getcomposer.org/composer-1.phar > composer.phar
fi

# dummy user, no privilege github token to avoid github api limit
php composer.phar config -g github-oauth.github.com 98cbc568911ef1e060a3a31623f2c80c1786d5ff

rm -f bootstrap/cache/*.php bootstrap/cache/*.json

if [ -z "${OSU_INSTALL_DEV:-}" ]; then
  php composer.phar install --no-dev
else
  php composer.phar install
fi

php artisan view:clear

# e.g. OSU_SKIP_DB_MIGRATION=1 ./build.sh to bypass running migrations
if [ -z "${OSU_SKIP_DB_MIGRATION:-}" ]; then
  php artisan migrate --force
else
  echo "OSU_SKIP_DB_MIGRATION set, skipping DB migration."
fi

php artisan passport:keys

# e.g. OSU_SKIP_ASSET_BUILD=1 ./build.sh to bypass building javascript assets
if [ -z "${OSU_SKIP_ASSET_BUILD:-}" ]; then
  if [ ! -d node_modules ]; then
    mkdir -p ~/node_modules
    ln -snf ~/node_modules node_modules
  fi

  command -v yarn || npm install -g yarn
  yarn
  yarn run production
else
  echo "OSU_SKIP_ASSET_BUILD set, skipping javascript asset build."
fi
