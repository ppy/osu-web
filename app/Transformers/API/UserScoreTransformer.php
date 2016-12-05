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

namespace App\Transformers\API;

use App\Models\Score;
use League\Fractal;

class UserScoreTransformer extends Fractal\TransformerAbstract
{
    public function transform(Score\Model $score)
    {
        $pp = [];
        if (is_subclass_of($score, 'App\Models\Score\Best\Model')) {
            $pp = ['pp' => round($score->pp, 4)];
        }

        return array_merge([
            'beatmap_id' => $score->beatmap_id,
            'score' => $score->score,
            'maxcombo' => $score->maxcombo,
            'count50' => $score->count50,
            'count100' => $score->count100,
            'count300' => $score->count300,
            'countmiss' => $score->countmiss,
            'countkatu' => $score->countkatu,
            'countgeki' => $score->countgeki,
            'perfect' => $score->perfect,
            'enabled_mods' => $score->enabled_mods,
            'user_id' => $score->user_id,
            'date' => $score->date->tz('Australia/Perth')->toDateTimeString(),
            'rank' => $score->rank,
        ], $pp);
    }
}
