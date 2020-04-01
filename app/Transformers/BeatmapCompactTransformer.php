<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;

class BeatmapCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmapset',
    ];

    public function transform(Beatmap $beatmap)
    {
        return [
            'id' => $beatmap->beatmap_id,
            'mode' => $beatmap->mode,
            'difficulty_rating' => $beatmap->difficultyrating,
            'version' => $beatmap->version,
        ];
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        return $this->item($beatmap->beatmapset, new BeatmapsetCompactTransformer);
    }
}
