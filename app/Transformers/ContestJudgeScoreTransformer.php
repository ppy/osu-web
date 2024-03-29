<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers;

use App\Models\ContestJudgeScore;

class ContestJudgeScoreTransformer extends TransformerAbstract
{
    public function transform(ContestJudgeScore $score): array
    {
        return [
            'contest_scoring_category_id' => $score->contest_scoring_category_id,
            'id' => $score->getKey(),
            'value' => $score->value,
        ];
    }
}
