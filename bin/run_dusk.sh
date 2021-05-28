#!/bin/sh

# wrapped in () so it doesn't mess up caller working directory
start_notification_server() { (
    if [ -d osu-notification-server ]; then
        cd osu-notification-server
        git pull
    else
        git clone https://github.com/ppy/osu-notification-server
        cd osu-notification-server
    fi
    ln -sf ../.env
    ln -sf ../storage/oauth-public.key
    yarn
    yarn build
    yarn serve > server.log 2>&1 &
) }

# install latest chrome driver
php artisan dusk:chrome-driver --detect

# start the standalone server and notification server that the tests use
php artisan serve > /dev/null 2>&1 &
start_notification_server

# run the tests
php artisan dusk --verbose
EXIT_CODE=$?

# 'cleanup'
pkill -f "php artisan serve"

exit $EXIT_CODE
