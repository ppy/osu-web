#!/bin/sh

export CHROME_BIN=/usr/bin/chromium
export DUSK_WEBDRIVER_BIN=/usr/bin/chromedriver
export YARN_CACHE_FOLDER=/app/.docker/.yarn
export COMPOSER_HOME=/app/.docker/.composer

command=octane
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

# commands
_job() {
    exec php /app/artisan queue:listen --queue=notification,default,beatmap_high,beatmap_default,store-notifications --tries=3 --timeout=1000
}

_migrate() {
    php /app/artisan db:create
    exec php /app/artisan migrate:fresh-or-run
}

_octane() {
  exec /app/artisan octane:start --host=0.0.0.0 "$@"
}

_schedule() {
    exec php /app/artisan schedule:work
}

_test() {
    command=phpunit
    if [ "$#" -gt 0 ]; then
        command="$1"
        shift
    fi

    case "$command" in
        browser) _test_browser "$@";;
        js) exec yarn karma start --single-run --browsers ChromeHeadless "$@";;
        phpunit) exec ./bin/phpunit.sh "$@";;
    esac
}

_test_browser() {
    export APP_ENV=dusk.local
    exec php /app/artisan dusk "$@"
}


_watch() {
    yarn --network-timeout 100000
    exec yarn watch
}

case "$command" in
    artisan) exec php /app/artisan "$@";;
    job|migrate|octane|schedule|test|watch) "_$command" "$@";;
    *) exec "$command" "$@";;
esac
