#!/bin/sh

set -e
set -u

# goes to top directory.
cd "$(dirname "${0}")/.."

for db in osu osu_store osu_mp osu_chat osu_charts osu_updates; do
  echo "CREATE DATABASE ${db} DEFAULT CHARSET utf8mb4" | mysql -u root
done
