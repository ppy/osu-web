<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Solo;

use App\Models\LegacyMatch;
use App\Models\Score\Model as ScoreModel;
use App\Models\Solo\Score as SoloScore;
use App\Transformers\ScoreTransformer as BaseScoreTransformer;

class ScoreTransformer extends BaseScoreTransformer
{
    public function transform(LegacyMatch\Score|ScoreModel|SoloScore $score)
    {
        if ($score instanceof ScoreModel) {
            $legacyPerfect = $score->perfect;
            $best = $score->best;

            if ($best !== null) {
                $bestId = $best->getKey();
                $pp = $best->pp;
                $replay = $best->replay;
            }
        }

        return array_merge($score->data->jsonSerialize(), [
            'best_id' => $bestId ?? null,
            'id' => $score->getKey(),
            'legacy_perfect' => $legacyPerfect ?? null,
            'pp' => $pp ?? null,
            'replay' => $replay ?? false,
        ]);
    }
}
