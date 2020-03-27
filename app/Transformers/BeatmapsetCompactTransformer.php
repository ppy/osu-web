<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmapset;
use League\Fractal;

class BeatmapsetCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmaps',
    ];

    public function transform(Beatmapset $beatmapset)
    {
        return [
            'artist' => $beatmapset->artist,
            'covers' => $beatmapset->allCoverURLs(),
            'creator' => $beatmapset->creator,
            'favourite_count' => $beatmapset->favourite_count,
            'id' => $beatmapset->beatmapset_id,
            'play_count' => $beatmapset->play_count,
            'preview_url' => $beatmapset->previewURL(),
            'source' => $beatmapset->source,
            'status' => $beatmapset->status(),
            'title' => $beatmapset->title,
            'user_id' => $beatmapset->user_id,
            'video' => $beatmapset->video,
        ];
    }

    public function includeBeatmaps(Beatmapset $beatmapset, Fractal\ParamBag $params)
    {
        $rel = $params->get('with_trashed') ? 'allBeatmaps' : 'beatmaps';

        return $this->collection($beatmapset->$rel, new BeatmapCompactTransformer);
    }
}
