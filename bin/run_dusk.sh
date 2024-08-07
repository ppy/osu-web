#!/bin/sh

if ! pgrep chromedriver > /dev/null; then
    chromedriver_log=storage/logs/chromedriver.log
    chromedriver > "$chromedriver_log" 2>&1 &
    chrome_pid=$!
    # wait for the driver to be ready
    printf "Waiting for chromedriver to start..."
    tries=0
    while ! grep -qF "ChromeDriver was started successfully." "$chromedriver_log"; do
        printf .
        sleep 1
        tries=$(($tries + 1))
        if [ $tries -gt 10 ]; then
            echo "aborting: chromedriver is taking too long to start"
            cat "$chromedriver_log"
            kill "$chrome_pid"
            exit 1
        fi
    done
    echo done
fi

# start the standalone server that the tests use
php artisan octane:start > /dev/null 2>&1 &

# run the tests
php artisan dusk "$@"
EXIT_CODE=$?

php artisan octane:stop
test -n "$chrome_pid" && kill "$chrome_pid"

exit $EXIT_CODE
