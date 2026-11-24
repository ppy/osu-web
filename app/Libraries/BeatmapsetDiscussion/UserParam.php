<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\BeatmapsetDiscussion;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserParam
{
    public static function apply(Builder $query, array $rawParams, array $extraParams, array &$params): void
    {
        if (($extraParams['user'] ?? null) instanceof User) {
            $user = $extraParams['user'];
            $params['user'] = $user->getKey();
        } elseif (present(get_string($rawParams['user'] ?? null))) {
            $params['user'] = $rawParams['user'];
            $findAll = $extraParams['is_moderator'] || ($extraParams['current_user_id'] === $rawParams['user']);
            $user = User::lookup($params['user'], null, $findAll);
        } else {
            $params['user'] = null;

            return;
        }

        if ($user === null) {
            $query->none();
        } else {
            $query->where('user_id', $user->getKey());
        }
    }
}
