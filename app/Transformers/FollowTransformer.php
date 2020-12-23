<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Follow;

class FollowTransformer extends TransformerAbstract
{
    public function transform(Follow $follow)
    {
        return [
            'notifiable_id' => $follow->notifiable_id,
            'notifiable_type' => $follow->notifiable_type,
            'subtype' => $follow->subtype,
        ];
    }
}
