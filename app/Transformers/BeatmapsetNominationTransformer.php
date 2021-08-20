<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapsetNomination;

class BeatmapsetNominationTransformer extends TransformerAbstract
{
    public function transform(BeatmapsetNomination $nomination)
    {
        return [
            'beatmapset_id' => $nomination->beatmapset_id,
            'created_at' => json_time($nomination->created_at),
            'id' => $nomination->id,
            'modes' => $nomination->modes,
            'reset' => $nomination->reset,
            'reset_user_id' => $nomination->reset_user_id,
            'updated_at' => json_time($nomination->updated_at),
            'user_id' => $nomination->user_id,
        ];
    }
}
