<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\User;

class ProfileCount
{
    public static function scoresFirst(User $user, string $rulesetName, null | true $legacyOnly): int
    {
        $limitQuery = $user
            ->scoresFirst($rulesetName, $legacyOnly)
            ->limit(101)
            ->toRawSql();

        return $user->getConnection()->select("SELECT count(*) as c FROM ({$limitQuery}) t")[0]->c;
    }
}
