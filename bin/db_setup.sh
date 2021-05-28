#!/bin/sh

for db in osu osu_store osu_mp osu_chat osu_charts osu_updates; do
  echo "CREATE DATABASE IF NOT EXISTS ${db} DEFAULT CHARSET utf8mb4" | mysql -u root "$@"
  echo "CREATE DATABASE IF NOT EXISTS ${db}_test DEFAULT CHARSET utf8mb4" | mysql -u root "$@"
done
