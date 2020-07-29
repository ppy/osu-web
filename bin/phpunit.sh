#!/bin/sh

cd "$(dirname "$0")/.."

exec vendor/bin/phpunit --prepend=app/framework_helper_overrides.php "$@"
