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
        $attrs = $beatmap->getAttributes();

        return [
            'beatmapset_id' => $attrs['beatmapset_id'] ?? null,
            'difficulty_rating' => $beatmap->getDifficultyRatingAttribute($attrs['difficultyrating'] ?? null),
            'id' => $attrs['beatmap_id'] ?? null,
            'mode' => $beatmap->getModeAttribute(),
            'status' => $beatmap->status(),
            'total_length' => $attrs['total_length'] ?? null,
            'user_id' => $attrs['user_id'] ?? null,
            'version' => $beatmap->getVersionAttribute($attrs['version'] ?? null),
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
