#!/bin/sh

# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

set -e
set -u

_echo() {
    printf "%s\n" "$*"
}

DEBUG=0
NO_UPDATE=0
QUICK_FAIL=0
while getopts "dfn" opt
do
    case "$opt" in
        d) DEBUG=1;;
        f) QUICK_FAIL=1;;
        n) NO_UPDATE=1;;
    esac
done

if [ "$DEBUG" = 1 ]; then
    _debug() {
        _echo "$@"
    }
else
    _debug() {
        true
    }
fi

_fix() {
    old_header="$1"
    shift
    new_header="$1"
    shift
    pattern="$1"
    shift

    old_header_lines=$(_echo "$old_header" | wc -l)
    new_header_lines=$(_echo "$new_header" | wc -l)

    # please don't have files which name contains newline
    find "$@" -name "$pattern" | while read file; do
        case "$file" in
            database/migrations/2016_03_18_170000_create_oauth_scopes_table.php|\
            database/migrations/2016_03_18_170001_create_oauth_grants_table.php|\
            database/migrations/2016_03_18_170002_create_oauth_grant_scopes_table.php|\
            database/migrations/2016_03_18_170003_create_oauth_clients_table.php|\
            database/migrations/2016_03_18_170004_create_oauth_client_endpoints_table.php|\
            database/migrations/2016_03_18_170005_create_oauth_client_scopes_table.php|\
            database/migrations/2016_03_18_170006_create_oauth_client_grants_table.php|\
            database/migrations/2016_03_18_170007_create_oauth_sessions_table.php|\
            database/migrations/2016_03_18_170008_create_oauth_session_scopes_table.php|\
            database/migrations/2016_03_18_170009_create_oauth_auth_codes_table.php|\
            database/migrations/2016_03_18_170010_create_oauth_auth_code_scopes_table.php|\
            database/migrations/2016_03_18_170011_create_oauth_access_tokens_table.php|\
            database/migrations/2016_03_18_170012_create_oauth_access_token_scopes_table.php|\
            database/migrations/2016_03_18_170013_create_oauth_refresh_tokens_table.php|\
            resources/assets/build/*|\
            resources/assets/js/ziggy.js|\
            resources/assets/less/jquery-ui/slider.less|\
            resources/assets/less/jquery-ui/theme.less|\
            resources/assets/less/spinner.less|\
            resources/assets/less/torus.less)
                _debug "S $file"
                continue
            ;;
        esac

        new_current_header=$(head -n "$new_header_lines" "$file")
        if [ "$new_current_header" = "$new_header" ]; then
            continue
        fi

        old_current_header=$(head -n "$old_header_lines" "$file")
        if [ "$old_current_header" != "$old_header" ]; then
            echo "? $file"
            # As the whole process is inside pipe, there's no way to modify global variable.
            # This is needed to tell travis the correct return code.
            if [ "$QUICK_FAIL" = 1 ]; then
                echo "Found file with invalid licence header."
                echo "QUICK_FAIL (-f) option enabled, stopping check."
                echo "Run without -f for full check."
                exit 1
            fi
            continue
        fi

        if [ "$NO_UPDATE" = 1 ]; then
            echo "! $file"

            if [ "$QUICK_FAIL" = 1 ]; then
                echo "Found file with outdated licence header."
                echo "QUICK_FAIL (-f) and NO_UPDATE (-n) option enabled, stopping check."
                echo "Run without -f and -n to update headers."
                exit 1
            fi

            continue
        fi


        lines=$(cat "$file" | wc -l)
        content=$(tail -n $(($lines - $old_header_lines)) "$file")
        (
            _echo "$new_header"
            _echo "$content"
        ) > "$file"
        _debug "U $file"
    done
}

licence_old_blade=$(cat <<EOF
{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
EOF
)

licence_old_c=$(cat <<EOF
/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
EOF
)

licence_old_coffee=$(cat <<EOF
###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
EOF
)

licence_old_php=$(printf "<?php\n\n%s" "$licence_old_c")

licence_new_blade=$(cat <<EOF
{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
EOF
)

licence_new_c=$(cat <<EOF
// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
EOF
)

licence_new_coffee=$(cat <<EOF
# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.
EOF
)

licence_new_php=$(printf "<?php\n\n%s" "$licence_new_c")

_fix "${licence_old_php}" "${licence_new_php}" '*.php' app/ database/ resources/lang/en/ routes/ tests/
_fix "${licence_old_blade}" "${licence_new_blade}" '*.blade.php' resources/views/

_fix "${licence_old_c}" "${licence_new_c}" '*.less' resources/assets/

_fix "${licence_old_c}" "${licence_new_c}" '*.ts' tests/
_fix "${licence_old_c}" "${licence_new_c}" '*.ts' resources/assets/
_fix "${licence_old_c}" "${licence_new_c}" '*.tsx' resources/assets/
_fix "${licence_old_c}" "${licence_new_c}" '*.js' resources/assets/
_fix "${licence_old_c}" "${licence_new_c}" '*.js' *.js

_fix "${licence_old_coffee}" "${licence_new_coffee}" '*.coffee' resources/assets/
