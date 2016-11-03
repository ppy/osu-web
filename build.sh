#!/bin/sh

set -u
set -e

# the user when provisioning is `vagrant`, but files are created by `www-data`
# don't fail if permissions don't get set on all files (useful when reloading the container)
chmod -R 777 storage bootstrap/cache || true

if [ ! -d node_modules ]; then
  mkdir -p ~/node_modules
  ln -snf ~/node_modules node_modules
fi

curl -sL https://getcomposer.org/installer > composer-installer
php composer-installer

# dummy user, no privilege github token to avoid github api limit
php composer.phar config -g github-oauth.github.com 98cbc568911ef1e060a3a31623f2c80c1786d5ff

rm -f bootstrap/cache/*.php bootstrap/cache/*.json

php composer.phar install

php artisan migrate --force
php artisan lang:js resources/assets/js/messages.js
php artisan laroute:generate

npm install -g yarn
yarn
./node_modules/gulp/bin/gulp.js --production
