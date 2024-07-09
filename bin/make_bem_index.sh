#!/bin/sh

# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

cd "$(dirname "$0")/../resources/css"

tmpfile=.bem-index.less.tmp
cat << EOF > "$tmpfile"
// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

EOF

find bem/ -name '*.less' -type f | while read line; do
    printf '@import "%s";\n' "${line%.*}"
done | sort >> "$tmpfile"

mv -f "$tmpfile" bem-index.less
