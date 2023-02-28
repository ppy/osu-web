<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Solo;

use App\Models\Solo\ScoreToken;
use App\Transformers\TransformerAbstract;

class ScoreTokenTransformer extends TransformerAbstract
{
    public function transform(ScoreToken $scoreToken)
    {
        return [
            'beatmap_id' => $scoreToken->beatmap_id,
            'created_at' => json_time($scoreToken->created_at),
            'id' => $scoreToken->getKey(),
            'user_id' => $scoreToken->user_id,
        ];
    }
}
