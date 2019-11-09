<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\API;

use App\Models\Score;
use League\Fractal;

class ScoreTransformer extends Fractal\TransformerAbstract
{
    public function transform(Score\Model $score)
    {
        return [
            'score_id' => $score->score_id,
            'score' => $score->score,
            'username' => $score->user->username,
            'user_id' => $score->user_id,
            'maxcombo' => $score->maxcombo,
            'count50' => $score->count50,
            'count100' => $score->count100,
            'count300' => $score->count300,
            'countmiss' => $score->countmiss,
            'countkatu' => $score->countkatu,
            'countgeki' => $score->countgeki,
            'perfect' => $score->perfect,
            'enabled_mods' => $score->enabled_mods,
            'date' => $score->date->tz('Australia/Perth')->toDateTimeString(),
            'user_id' => $score->user_id,
            'rank' => $score->rank,
            'pp' => round($score->pp, 4),
            'replay' => $score->replay,
        ];
    }
}
