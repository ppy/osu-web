<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ScoreToken;

class ScoreTokenTransformer extends TransformerAbstract
{
    public function transform(ScoreToken $scoreToken)
    {
        return [
            'beatmap_id' => $scoreToken->beatmap_id,
            'created_at' => $scoreToken->created_at_json,
            'id' => $scoreToken->getKey(),
            'playlist_item_id' => $scoreToken->playlist_item_id,
            'user_id' => $scoreToken->user_id,
        ];
    }
}
