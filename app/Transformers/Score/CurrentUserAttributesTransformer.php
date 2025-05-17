<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers\Score;

use App\Models\LegacyMatch;
use App\Models\Multiplayer\ScoreLink as MultiplayerScoreLink;
use App\Models\Solo\Score as SoloScore;
use App\Transformers\TransformerAbstract;

class CurrentUserAttributesTransformer extends TransformerAbstract
{
    public function transform(LegacyMatch\Score|MultiplayerScoreLink|SoloScore $score): array
    {
        if ($score instanceof SoloScore) {
            $pinnable = $score;
        } elseif ($score instanceof MultiplayerScoreLink) {
            $pinnable = $score->score;
        } else {
            $pinnable = null;
        }

        return [
            'pin' => $pinnable !== null && $this->isOwnScore($pinnable)
                ? [
                    'is_pinned' => app('score-pins')->isPinned($pinnable),
                    'score_id' => $pinnable->getKey(),
                ] : null,
        ];
    }

    private function isOwnScore(LegacyMatch\Score|MultiplayerScoreLink|SoloScore $score): bool
    {
        return $score->user_id === \Auth::user()?->getKey();
    }
}
