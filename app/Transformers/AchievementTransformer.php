<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Achievement;

class AchievementTransformer extends TransformerAbstract
{
    public function transform(Achievement $achievement)
    {
        return [
            'icon_url' => $achievement->iconUrl(),
            'id' => $achievement->achievement_id,
            'name' => $achievement->name,
            'grouping' => $achievement->grouping,
            'ordering' => $achievement->ordering,
            'slug' => $achievement->slug,
            'description' => $achievement->description,
            'mode' => $achievement->mode,
            'instructions' => $achievement->quest_instructions,
        ];
    }
}
