<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserBadge;

class UserBadgeTransformer extends TransformerAbstract
{
    public function transform(UserBadge $badge)
    {
        return [
            'awarded_at' => json_time($badge->awarded),
            'description' => $badge->description,
            'image_url' => $badge->imageUrl(),
            'url' => $badge->url,
        ];
    }
}
