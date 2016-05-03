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

use App\Models\Beatmap;
use League\Fractal;

class BeatmapTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'scoresBest',
        'failtimes',
    ];

    public function transform(Beatmap $beatmap = null)
    {
        if ($beatmap === null) {
            return [];
        }

        return [
            'id' => $beatmap->beatmap_id,
            'beatmapset_id' => $beatmap->beatmapset_id,
            'mode' => $beatmap->mode,
            'mode_int' => $beatmap->playmode,
            'difficulty_size' => $beatmap->diff_size,
            'difficulty_rating' => $beatmap->difficultyrating,
            'version' => $beatmap->version,
            'total_length' => $beatmap->total_length,
            'cs' => $beatmap->diff_size,
            'drain' => $beatmap->diff_drain,
            'accuracy' => $beatmap->diff_overall,
            'ar' => $beatmap->diff_approach,
            'playcount' => $beatmap->playcount,
            'passcount' => $beatmap->passcount,
            'url' => route('beatmaps.show', ['id' => $beatmap->beatmap_id]),
        ];
    }

    public function includeScoresBest(Beatmap $beatmap)
    {
        $scores = $beatmap
            ->scoresBest()
            ->orderBy('score', 'desc')
            ->limit(config('osu.beatmaps.max-scores'))
            ->get();

        return $this->collection($scores, new ScoreTransformer);
    }

    public function includeFailtimes(Beatmap $beatmap)
    {
        return $this->collection($beatmap->failtimes()->orderBy('type', 'asc')->get(), new BeatmapFailtimesTransformer);
    }
}
