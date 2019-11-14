#!/bin/sh

set -u
set -e

export OSU_INSTALL_DEV=1
export OSU_SKIP_CACHE_PERMISSION_OVERRIDE=1
export OSU_SKIP_ASSET_BUILD=1

scriptdir="$(dirname "${0}")"
cd "${scriptdir}/../.."

test -f .env || cp .env.example .env
"${scriptdir}/wait-for.sh" "${1}" -t 60
./build.sh

# undo config and route caching by the script above
php artisan config:clear
php artisan route:clear

yarn

exec yarn watch
