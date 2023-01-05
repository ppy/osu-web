#!/bin/sh

set -e
set -u

outfile="$(dirname "${0}")/../database/ip2asn-combined.tsv"
curl https://iptoasn.com/data/ip2asn-combined.tsv.gz | gzip -d > "${outfile}.new"
mv "${outfile}.new" "${outfile}"
