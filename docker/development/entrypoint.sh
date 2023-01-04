#!/bin/sh

set -e
set -u

export YARN_CACHE_FOLDER=/app/.docker/.yarn
export COMPOSER_HOME=/app/.docker/.composer

command=serve
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

uid="$(stat -c "%u" /app)"
gid="$(stat -c "%g" /app)"

if [ "$uid" != 0 ]; then
    usermod -u "$uid" -o osuweb > /dev/null
    groupmod -g "$gid" -o osuweb > /dev/null
fi

usermod -d /app/.docker osuweb > /dev/null

# helper functions
_rexec() {
    exec gosu osuweb "$@"
}

_run() {
    gosu osuweb "$@"
}

# commands
_job() {
    _rexec php /app/artisan queue:listen --queue=notification,default,beatmap_high,beatmap_default,store-notifications --tries=3 --timeout=1000
}

_migrate() {
    _run php /app/artisan db:create
    _rexec php /app/artisan migrate:fresh-or-run
}

_octane() {
  exec /app/artisan octane:start --host=0.0.0.0 "$@"
}

_schedule() {
    while sleep 300; do
        _run php /app/artisan schedule:run &
        echo 'Sleeping for 5 minutes'
    done
}

_test() {
    command=phpunit
    if [ "$#" -gt 0 ]; then
        command="$1"
        shift
    fi

    case "$command" in
        browser) _rexec php /app/artisan dusk --verbose "$@";;
        js) _rexec yarn karma start --single-run --browsers ChromeHeadless "$@";;
        phpunit) _rexec ./bin/phpunit.sh "$@";;
    esac
}

_watch() {
    _run yarn --network-timeout 100000
    _rexec yarn watch
}

case "$command" in
    artisan) _rexec php /app/artisan "$@";;
    job|migrate|octane|schedule|test|watch) "_$command" "$@";;
    *) _rexec "$command" "$@";;
esac
