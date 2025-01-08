#!/bin/sh

cd "$(dirname "$0")/.."

./docker/development/prepare.sh && ./user-mirror docker compose up "$@"
