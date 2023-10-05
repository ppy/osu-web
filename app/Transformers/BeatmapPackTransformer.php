<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapPack;

class BeatmapPackTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'beatmapsets',
        'user_completion_data',
    ];

    private $userCompletionData;

    public function __construct($userCompletionData = null)
    {
        $this->userCompletionData = $userCompletionData;
    }

    public function transform(BeatmapPack $pack)
    {
        return [
            'author' => $pack->author,
            'date' => $pack->date,
            'hidden' => $pack->hidden,
            'name' => $pack->name,
            'pack_id' => $pack->pack_id,
            'no_diff_reduction' => $pack->no_diff_reduction,
            'playmode' => $pack->playmode,
            'tag' => $pack->tag,
            'url' => $pack->url,
        ];
    }

    public function includeBeatmapsets(BeatmapPack $pack)
    {
        return $this->collection($pack->beatmapsets, new BeatmapsetTransformer());
    }

    public function includeUserCompletionData(BeatmapPack $pack)
    {
        return $this->primitive([
            'completed' => $this->userCompletionData['completed'],
            'beatmapset_ids' => $this->userCompletionData['beatmapset_ids'],
        ]);
    }
}
