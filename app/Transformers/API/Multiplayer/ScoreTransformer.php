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

namespace App\Transformers\API\Multiplayer;

use App\Models\Multiplayer\Score;
use League\Fractal;

class ScoreTransformer extends Fractal\TransformerAbstract
{
    public function transform(Score $score)
    {
        return [
            'slot' => $score->slot,
            'team' => $score->team,
            'user_id' => $score->user_id,
            'score' => $score->score,
            'maxcombo' => $score->maxcombo,
            'rank' => $score->rank,
            'count50' => $score->count50,
            'count100' => $score->count100,
            'count300' => $score->count300,
            'countmiss' => $score->countmiss,
            'countgeki' => $score->countgeki,
            'countkatu' => $score->countkatu,
            'perfect' => $score->perfect,
            'pass' => $score->pass,
        ];
    }
}
