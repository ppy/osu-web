#!/bin/sh

cd "$(dirname "$0")/.."

export APP_URL=http://localhost

exec vendor/bin/phpunit "$@"
