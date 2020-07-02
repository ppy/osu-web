#!/bin/sh

export YARN_CACHE_FOLDER=/app/.docker/.yarn
export COMPOSER_HOME=/app/.docker/.composer

command=serve
if [ "$#" -gt 0 ]; then
    command="$1"
    shift
fi

uid="$(stat -c "%u" /app)"
gid="$(stat -c "%g" /app)"

usermod -u "$uid" -d /app/.docker osuweb > /dev/null
groupmod -g "$gid" osuweb > /dev/null

# helper functions
_rexec() {
    exec gosu osuweb "$@"
}

_run() {
    gosu osuweb "$@"
}

# commands
_job() {
    _rexec /app/artisan queue:listen --queue=notification,default,beatmap_high,beatmap_default,store-notifications --tries=3 --timeout=1000
}

_schedule() {
    while sleep 300; do
        _run /app/artisan schedule:run &
        echo 'Sleeping for 5 minutes'
    done
}

_serve() {
    exec php-fpm7.4 -y docker/development/php-fpm.conf
}

_watch() {
    _run yarnpkg
    _rexec yarnpkg watch
}

case "$command" in
    artisan) _rexec /app/artisan "$@";;
    job|schedule|serve|watch) "_$command";;
    *) _rexec "$command" "$@";;
esac
