#!/bin/sh

# start the headless driver and standalone server that the tests use
google-chrome-stable --headless --disable-gpu --remote-debugging-port=9222 http://localhost &
php artisan serve > /dev/null 2>&1 &

# run the tests
php artisan dusk --verbose
EXIT_CODE=$?

# 'cleanup'
pkill google-chrome-stable
pkill -f "php artisan serve"

exit $EXIT_CODE
