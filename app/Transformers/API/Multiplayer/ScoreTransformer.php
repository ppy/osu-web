<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\API\Multiplayer;

use App\Models\Multiplayer\Score;
use App\Transformers\TransformerAbstract;

class ScoreTransformer extends TransformerAbstract
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
