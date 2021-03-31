<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Build;

class ClientCheck
{
    public static function assert($user, $params)
    {
        if (!config('osu.client.check_version') || $user->findUserGroup(app('groups')->byIdentifier('admin'), true) !== null) {
            return;
        }

        $clientHash = presence(get_string($params['version_hash'] ?? null));
        abort_if($clientHash === null, 422, 'missing client version');

        // temporary measure to allow android builds to submit without access to the underlying dll to hash
        if (strlen($clientHash) !== 32) {
            $clientHash = md5($clientHash);
        }

        $buildExists = Build::where([
            'hash' => hex2bin($clientHash),
            'allow_ranking' => true,
        ])->exists();
        abort_if(!$buildExists, 422, 'invalid client hash');
    }
}
