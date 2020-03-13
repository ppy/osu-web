<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmapset;

class BeatmapsetCompactTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'beatmaps',
    ];

    public function transform(Beatmapset $beatmapset)
    {
        return [
            'id' => $beatmapset->beatmapset_id,
            'title' => $beatmapset->title,
            'artist' => $beatmapset->artist,
            'creator' => $beatmapset->creator,
            'user_id' => $beatmapset->user_id,
            'covers' => $beatmapset->allCoverURLs(),
            'favourite_count' => $beatmapset->favourite_count,
            'play_count' => $beatmapset->play_count,
            'preview_url' => $beatmapset->previewURL(),
            'video' => $beatmapset->video,
            'source' => $beatmapset->source,
            'status' => $beatmapset->status(),
        ];
    }

    public function includeBeatmaps(Beatmapset $beatmapset)
    {
        return $this->collection(
            $beatmapset->beatmaps,
            new BeatmapCompactTransformer()
        );
    }
}
