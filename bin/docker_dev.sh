#!/bin/sh

cd "$(dirname "$0")/.."

./docker/development/prepare.sh && exec docker compose up "$@"
