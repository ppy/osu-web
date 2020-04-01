<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserAchievement;

class UserAchievementTransformer extends TransformerAbstract
{
    public function transform(UserAchievement $userAchievement)
    {
        return [
            'achieved_at' => json_time($userAchievement->date),
            'achievement_id' => $userAchievement->achievement_id,
        ];
    }
}
