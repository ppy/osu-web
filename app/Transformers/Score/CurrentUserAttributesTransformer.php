<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers\Score;

use App\Models\LegacyMatch;
use App\Models\Score\Best\Model as ScoreBest;
use App\Models\Score\Model as ScoreModel;
use App\Transformers\TransformerAbstract;

class CurrentUserAttributesTransformer extends TransformerAbstract
{
    public function transform(LegacyMatch\Score|ScoreModel $score): array
    {
        return [
            'pin' => $score instanceof ScoreBest && $this->isOwnScore($score)
                ? [
                    'is_pinned' => app('score-pins')->isPinned($score),
                    'score_id' => $score->getKey(),
                    'score_type' => $score->getMorphClass(),
                ] : null,
        ];
    }

    private function isOwnScore(LegacyMatch\Score|ScoreModel $score)
    {
        return $score->user_id === auth()->user()?->getKey();
    }
}
