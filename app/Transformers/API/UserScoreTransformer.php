<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\API;

use App\Models\Score;
use App\Transformers\TransformerAbstract;

class UserScoreTransformer extends TransformerAbstract
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
