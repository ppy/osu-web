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
        return array_merge(parent::transform($beatmap), [
            'accuracy' => $beatmap->getAttr('diff_overall'),
            'ar' => $beatmap->getAttr('diff_approach'),
            'bpm' => $beatmap->getAttr('bpm'),
            'convert' => $beatmap->convert,
            'count_circles' => $beatmap->getAttr('countNormal'),
            'count_sliders' => $beatmap->getAttr('countSlider'),
            'count_spinners' => $beatmap->getAttr('countSpinner'),
            'cs' => $beatmap->getDiffSizeAttribute(),
            'deleted_at' => json_time_from_db_timestamp($beatmap->getAttr('deleted_at')),
            'drain' => $beatmap->getAttr('diff_drain'),
            'hit_length' => $beatmap->getAttr('hit_length'),
            'is_scoreable' => $beatmap->isScoreable(),
            'last_updated' => json_time_from_db_timestamp($beatmap->getAttr('last_update')),
            'mode_int' => $beatmap->getAttr('playmode'),
            'passcount' => $beatmap->getAttr('passcount'),
            'playcount' => $beatmap->getAttr('playcount'),
            'ranked' => $beatmap->getAttr('approved'),
            'url' => route('beatmaps.show', ['beatmap' => $beatmap->getKey()]),
        ]);
    }
}
