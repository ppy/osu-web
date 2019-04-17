#!/bin/sh

set -eu

node_modules/tslint/bin/tslint -c tslint.json 'resources/**/*.{ts,tsx}'
EXIT_CODE=$?

exit $EXIT_CODE
