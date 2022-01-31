<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers\Score;

use App\Models\LegacyMatch;
use App\Models\Score\Model as ScoreModel;
use App\Transformers\TransformerAbstract;

class CurrentUserAttributesTransformer extends TransformerAbstract
{
    public function transform(LegacyMatch\Score|ScoreModel $score): array
    {
        $best = $score->best;

        return [
            'pin' => $best !== null && $this->isOwnScore($best)
                ? [
                    'is_pinned' => app('score-pins')->isPinned($best),
                    'score_id' => $best->getKey(),
                    'score_type' => $best->getMorphClass(),
                ] : null,
        ];
    }

    private function isOwnScore(LegacyMatch\Score|ScoreModel $score): bool
    {
        return $score->user_id === auth()->user()?->getKey();
    }
}
