<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Solo;

use App\Models\Solo\Score;
use App\Transformers\TransformerAbstract;

class ScoreTransformer extends TransformerAbstract
{
    public function transform(Score $score)
    {
        return [
            'accuracy' => $score->accuracy,
            'beatmap_id' => $score->beatmap_id,
            'ended_at' => json_time($score->ended_at),
            'id' => $score->getKey(),
            'max_combo' => $score->max_combo,
            'mods' => $score->mods,
            'passed' => $score->passed,
            'rank' => $score->rank,
            'ruleset_id' => $score->ruleset_id,
            'started_at' => json_time($score->started_at),
            'statistics' => $score->statistics,
            'total_score' => $score->total_score,
            'user_id' => $score->user_id,
        ];
    }
}
