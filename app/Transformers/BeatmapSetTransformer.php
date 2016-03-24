<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Models\BeatmapSet;
use League\Fractal;

class BeatmapSetTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'difficulties',
    ];

    public function transform(BeatmapSet $beatmap = null)
    {
        if ($beatmap === null) {
            return [];
        }

        return [
            'beatmapset_id' => $beatmap->beatmapset_id,
            'title' => $beatmap->title,
            'artist' => $beatmap->artist,
            'play_count' => $beatmap->play_count,
            'favourite_count' => $beatmap->favourite_count,
            'creator' => $beatmap->creator,
            'user_id' => $beatmap->user_id,
            'source' => $beatmap->source,
            'covers' => $beatmap->allCoverURLs(),
        ];
    }

    public function includeDifficulties(BeatmapSet $beatmapSet)
    {
        return $this->collection(
            $beatmapSet->beatmaps()->orderBy('playmode', 'asc')->orderBy('difficultyrating', 'asc')->get(),
            new BeatmapDifficultyTransformer()
        );
    }
}
