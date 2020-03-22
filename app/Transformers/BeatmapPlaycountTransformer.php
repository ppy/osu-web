<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapPlaycount;

class BeatmapPlaycountTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'beatmap',
        'beatmapset',
    ];

    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
    ];

    public function transform(BeatmapPlaycount $playcount)
    {
        return [
            'beatmap_id' => $playcount->beatmap_id,
            'count' => $playcount->playcount,
        ];
    }

    public function includeBeatmap(BeatmapPlaycount $playcount)
    {
        if ($playcount->beatmap === null) {
            return;
        }

        return $this->item(
            $playcount->beatmap,
            new BeatmapCompactTransformer()
        );
    }

    public function includeBeatmapset(BeatmapPlaycount $playcount)
    {
        if ($playcount->beatmap === null) {
            return;
        }

        return $this->item(
            $playcount->beatmap->beatmapset,
            new BeatmapsetCompactTransformer()
        );
    }
}
