#!/bin/sh

if ! pgrep chromedriver > /dev/null; then
    chromedriver_log=storage/logs/chromedriver.log
    chromedriver --port=9515 > "$chromedriver_log" 2>&1 &
    chromedriver_pid=$!
    # wait for the driver to be ready
    printf "Waiting for chromedriver to start..."
    chromedriver_tries=0
    while ! grep -qF "ChromeDriver was started successfully on port 9515." "$chromedriver_log"; do
        printf .
        sleep 1
        chromedriver_tries=$(($chromedriver_tries + 1))
        if [ $chromedriver_tries -gt 10 ]; then
            echo "aborting: chromedriver is taking too long to start"
            cat "$chromedriver_log"
            kill "$chromedriver_pid"
            exit 1
        fi
    done
    echo done
fi

# start the standalone server that the tests use
php artisan octane:start --server=swoole > /dev/null 2>&1 &

# run the tests
php artisan dusk "$@"
EXIT_CODE=$?

php artisan octane:stop
test -n "$chromedriver_pid" && kill "$chromedriver_pid"

exit $EXIT_CODE
