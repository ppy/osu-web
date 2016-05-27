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

use App\Models\Score\Model as Score;
use App\Models\Score\Best\Model as ScoreBest;
use League\Fractal;

class ScoreTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmap',
        'beatmapset',
        'weight',
        'user',
    ];

    public function transform(Score $score)
    {
        return [
            'id' => $score->score_id,
            'user_id' => $score->user_id,
            'created_at' => $score->date->toIso8601String(),
            'pp' => $score->pp,
            'accuracy' => $score->accuracy(),
            'rank' => $score->rank,
            'mods' => $score->enabled_mods,
            'score' => $score->score,
            'count50' => $score->count50,
            'count100' => $score->count100,
            'count300' => $score->count300,
        ];
    }

    public function includeBeatmap(Score $score)
    {
        return $this->item($score->beatmap, new BeatmapTransformer);
    }

    public function includeBeatmapset(Score $score)
    {
        return $this->item($score->beatmapset, new BeatmapsetTransformer);
    }

    public function includeWeight(Score $score)
    {
        if (($score instanceof ScoreBest) === false) {
            return;
        }

        return $this->item($score, function ($score) {
            return [
                'percentage' => $score->weight() * 100,
                'pp' => $score->weightedPp(),
            ];
        });
    }

    public function includeUser(Score $score)
    {
        return $this->item($score->user, new UserCompactTransformer);
    }
}
