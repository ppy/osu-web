#!/bin/sh

# install latest chrome driver
php artisan dusk:chrome-driver --detect

# start the standalone server that the tests use
php artisan octane:start > /dev/null 2>&1 &

# run the tests
php artisan dusk --verbose "$@"
EXIT_CODE=$?

php artisan octane:stop

exit $EXIT_CODE
