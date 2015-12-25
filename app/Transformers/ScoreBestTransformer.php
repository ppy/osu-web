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

use App\Models\Score\Best\Model as ScoreBest;
use League\Fractal;

class ScoreBestTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapSet',
    ];

    public function transform(ScoreBest $scoreBest)
    {
        return [
            'id' => $scoreBest->score_id,
            'created_at' => $scoreBest->date->toIso8601String(),
            'pp' => $scoreBest->pp,
            'weight' => $scoreBest->weight(),
            'weightedPp' => $scoreBest->weightedPp(),
            'accuracy' => $scoreBest->accuracy(),
            'rank' => $scoreBest->rank,
            'mods' => $scoreBest->enabled_mods,
        ];
    }

    public function includeBeatmap(ScoreBest $scoreBest)
    {
        return $this->item($scoreBest->beatmap, new BeatmapTransformer);
    }

    public function includeBeatmapSet(ScoreBest $scoreBest)
    {
        return $this->item($scoreBest->beatmapSet, new BeatmapSetTransformer);
    }
}
