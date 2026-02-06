#!/bin/sh

set -e
set -u

scriptdir="$(dirname "$0")"
cd "$scriptdir/../.."

if [ ! -f artisan ]; then
    echo "This script is being run from unexpected place"
    exit 1
fi

_run() {
    docker compose run --rm php "$@"
}

for envfile in .env .env.testing .env.dusk.local; do
    if [ ! -f "${envfile}" ]; then
        echo "Copying env file '${envfile}'"
        cp "${envfile}.example" "${envfile}"
    fi
    if [ "${envfile}" != .env.testing ] && ! grep -q '^APP_KEY=.' "${envfile}"; then
        echo "Generating app key for env file '${envfile}'"
        sed -i -e '/^APP_KEY=.*/d' "${envfile}"
        : ${APP_KEY="base64:$(head -c 32 /dev/urandom | base64)"}
        echo "APP_KEY=${APP_KEY}" >> "${envfile}"
    fi
done

docker compose build
docker compose build testjs

if [ -n "${GITHUB_TOKEN:-}" ]; then
    _run composer config -g github-oauth.github.com "${GITHUB_TOKEN}"
    for envfile in .env .env.dusk.local; do
        grep -q '^GITHUB_TOKEN=' "${envfile}" || echo "GITHUB_TOKEN=${GITHUB_TOKEN}" >> "${envfile}"
    done
fi

_run yarn --network-timeout 100000 --frozen-lockfile

_run composer install

if [ -d storage/oauth-public.key ]; then
    echo "oauth-public.key is a directory. Removing it"
    rmdir storage/oauth-public.key
fi

if [ ! -f storage/oauth-public.key ]; then
    echo "Generating passport key pair"
    _run artisan passport:keys
    chmod 644 storage/oauth-public.key
fi

if [ ! -f .docker/.my.cnf ]; then
    echo "Copying default mysql client config"
    cp .docker/.my.cnf.example .docker/.my.cnf
fi

if [ ! -f database/ip2asn/v6.tsv ]; then
    _run artisan ip2asn:update
fi

echo "Preparation completed. Adjust .env file if needed and run 'docker compose up' followed by running migration."
