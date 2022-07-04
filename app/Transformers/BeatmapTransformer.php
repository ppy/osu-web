<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

class BeatmapTransformer extends BeatmapCompactTransformer
{
    protected $beatmapsetTransformer = BeatmapsetTransformer::class;
    protected $requiredPermission = 'BeatmapShow';

    protected $defaultIncludes = [
        'accuracy',
        'ar',
        'bpm',
        'checksum',
        'convert',
        'count_circles',
        'count_sliders',
        'count_spinners',
        'cs',
        'deleted_at',
        'drain',
        'hit_length',
        'is_scoreable',
        'last_updated',
        'mode_int',
        'passcount',
        'playcount',
        'ranked',
        'url',
    ];
}
