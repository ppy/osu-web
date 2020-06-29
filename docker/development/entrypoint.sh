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

_rexec() {
    exec gosu osuweb "$@"
}

_run() {
    gosu osuweb "$@"
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
    serve) _serve;;
    watch) _watch;;
    *) _rexec "$command" "$@";;
esac
