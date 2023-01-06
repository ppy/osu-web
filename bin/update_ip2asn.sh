#!/bin/sh

set -e
set -u

echo 'Updating ip2asn database...'

outfile="$(dirname "${0}")/../database/ip2asn-combined.tsv"
curl https://iptoasn.com/data/ip2asn-combined.tsv.gz | gzip -d > "${outfile}.new"
mv "${outfile}.new" "${outfile}"

echo 'Finished updating ip2asn database.'
