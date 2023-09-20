<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmapset;

class BeatmapsetDescriptionTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        'bbcode',
    ];

    protected $permissions = [
        'bbcode' => 'BeatmapsetDescriptionEdit',
    ];

    public function transform(Beatmapset $beatmapset)
    {
        return [
            'description' => $beatmapset->description(),
        ];
    }

    public function includeBbcode(Beatmapset $beatmapset)
    {
        return $this->primitive($beatmapset->editableDescription());
    }
}
