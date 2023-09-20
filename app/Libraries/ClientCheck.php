<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Build;

class ClientCheck
{
    public static function findBuild($user, $params): ?Build
    {
        $assertValid = config('osu.client.check_version') && $user->findUserGroup(app('groups')->byIdentifier('admin'), true) === null;

        $clientHash = presence(get_string($params['version_hash'] ?? null));
        if ($clientHash === null) {
            if ($assertValid) {
                abort(422, 'missing client version');
            } else {
                return null;
            }
        }

        // temporary measure to allow android builds to submit without access to the underlying dll to hash
        if (strlen($clientHash) !== 32) {
            $clientHash = md5($clientHash);
        }

        $build = Build::firstWhere([
            'hash' => hex2bin($clientHash),
            'allow_ranking' => true,
        ]);

        if ($build === null && $assertValid) {
            abort(422, 'invalid client hash');
        }

        return $build;
    }
}
