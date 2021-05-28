<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\BeatmapFailtimes;

class BeatmapCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmapset',
        'checksum',
        'failtimes',
        'max_combo',
    ];

    protected $beatmapsetTransformer = BeatmapsetCompactTransformer::class;

    public function transform(Beatmap $beatmap)
    {
        return [
            'difficulty_rating' => $beatmap->difficultyrating,
            'id' => $beatmap->beatmap_id,
            'mode' => $beatmap->mode,
            'status' => $beatmap->status(),
            'total_length' => $beatmap->total_length,
            'user_id' => $beatmap->user_id,
            'version' => $beatmap->version,
        ];
    }

    public function includeBeatmapset(Beatmap $beatmap)
    {
        $beatmapset = $beatmap->beatmapset;

        return $beatmapset === null
            ? $this->primitive(null)
            : $this->item($beatmap->beatmapset, new $this->beatmapsetTransformer());
    }

    public function includeChecksum(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->checksum);
    }

    public function includeFailtimes(Beatmap $beatmap)
    {
        $failtimes = $beatmap->failtimes;

        $result = [];

        foreach ($failtimes as $failtime) {
            $result[$failtime->type] = $failtime->data;
        }

        foreach (['exit', 'fail'] as $type) {
            if (!isset($result[$type])) {
                $result[$type] = (new BeatmapFailtimes())->data;
            }
        }

        return $this->primitive($result);
    }

    public function includeMaxCombo(Beatmap $beatmap)
    {
        return $this->primitive($beatmap->maxCombo());
    }
}
