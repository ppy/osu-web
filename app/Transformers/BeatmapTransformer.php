<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmap;

class BeatmapTransformer extends BeatmapCompactTransformer
{
    protected $beatmapsetTransformer = BeatmapsetTransformer::class;
    protected $requiredPermission = 'BeatmapShow';

    protected $defaultIncludes = [
        'checksum',
    ];

    public function transform(Beatmap $beatmap)
    {
        $result = parent::transform($beatmap);

        $attrs = $beatmap->getAttributes();

        return array_merge($result, [
            'accuracy' => $attrs['diff_overall'] ?? null,
            'ar' => $attrs['diff_approach'] ?? null,
            'bpm' => $attrs['bpm'] ?? null,
            'convert' => $beatmap->convert,
            'count_circles' => $attrs['countNormal'] ?? null,
            'count_sliders' => $attrs['countSlider'] ?? null,
            'count_spinners' => $attrs['countSpinner'] ?? null,
            'cs' => $beatmap->getDiffSizeAttribute(),
            'deleted_at' => json_time_from_db_timestamp($attrs['deleted_at'] ?? null),
            'drain' => $attrs['diff_drain'] ?? null,
            'hit_length' => $attrs['hit_length'] ?? null,
            'is_scoreable' => $beatmap->isScoreable(),
            'last_updated' => json_time_from_db_timestamp($attrs['last_update'] ?? null),
            'mode_int' => $attrs['playmode'] ?? null,
            'passcount' => $attrs['passcount'] ?? null,
            'playcount' => $attrs['playcount'] ?? null,
            'ranked' => $attrs['approved'] ?? null,
            'url' => route('beatmaps.show', ['beatmap' => $attrs['beatmap_id'] ?? null]),
        ]);
    }
}
