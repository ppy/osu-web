#!/bin/sh

set -u
set -e

# The user when provisioning is different than the user running actual php workers (in production).
if [ -z "${OSU_SKIP_CACHE_PERMISSION_OVERRIDE:-}" ]; then
    # Don't fail if permissions don't get set on all files.
    chmod -R 777 storage bootstrap/cache || true
fi

if [ -z "${OSU_USE_SYSTEM_COMPOSER:-}" ]; then
  COMPOSER="php composer.phar"

  if [ -f composer.phar ]; then
    php composer.phar self-update --2
  else
    curl -sL "https://getcomposer.org/download/latest-2.x/composer.phar" > composer.phar
  fi
else
  COMPOSER="composer"
fi

if [ -n "${GITHUB_TOKEN:-}" ]; then
  ${COMPOSER} config -g github-oauth.github.com "${GITHUB_TOKEN}"
fi

rm -f bootstrap/cache/*.php bootstrap/cache/*.json

if [ -z "${OSU_INSTALL_DEV:-}" ]; then
  ${COMPOSER} install --no-dev
else
  ${COMPOSER} install
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
