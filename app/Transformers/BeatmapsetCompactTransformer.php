<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Transformers;

use App\Models\Beatmapset;
use League\Fractal;

class BeatmapsetCompactTransformer extends Fractal\TransformerAbstract
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
