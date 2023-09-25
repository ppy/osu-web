<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

class UsernamesForDbLookup
{
    public static function make($username, bool $trimPrefix = true): array
    {
        $searchUsername = presence(get_string($username));

        if ($searchUsername === null) {
            return [];
        }

        if ($trimPrefix && $searchUsername[0] === '@') {
            $searchUsername = substr($searchUsername, 1);
        }

        return [
            $searchUsername,
            strtr($searchUsername, ' ', '_'),
            strtr($searchUsername, '_', ' '),
        ];
    }
}
