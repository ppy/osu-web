#!/bin/sh

set -u
set -e

export NOTIFICATION_SERVER_LISTEN_HOST=0.0.0.0

test -d notification-server || git clone https://github.com/ppy/osu-notification-server notification-server
cd notification-server

test -f .env || ln -sf ../.env
test -f oauth-public.key || ln -sf ../storage/oauth-public.key

yarn
yarn build

while true; do
    if [ -f oauth-public.key ]; then
        yarn serve || true

        printf "Notification server failed" 1>&2
    else
        printf "OAuth public key hasn't been created" 1>&2
    fi

    echo ". Sleeping for 5 seconds before starting again..." 1>&2
    sleep 5
done
