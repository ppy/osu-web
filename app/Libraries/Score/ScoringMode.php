<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Score;

use App\Enums\Ruleset;

class ScoringMode
{
    /**
     * @see https://github.com/ppy/osu/blob/cd3b455341dd1fe420f62235dab5598a4a15c3e0/osu.Game/Rulesets/Scoring/ScoreProcessor.cs#L32 Client reference
     */
    private const int MAX_SCORE = 1000000;

    /**
     * Convert a "Standardised" score value to a "Classic" score value.
     *
     * @see https://github.com/ppy/osu/blob/cd3b455341dd1fe420f62235dab5598a4a15c3e0/osu.Game/Scoring/Legacy/ScoreInfoExtensions.cs#L48-L65 Client reference
     */
    public static function convertToClassic(Ruleset $ruleset, int $standardisedScore, int $objectCount): int
    {
        // Keep in mind when translating this code from client that PHP and C#
        // have different behaviour for numeric type conversion and rounding
        return match ($ruleset) {
            Ruleset::osu => (int) round(
                ($objectCount ** 2 * 32.57 + 100000) * $standardisedScore / self::MAX_SCORE,
                mode: PHP_ROUND_HALF_EVEN,
            ),
            Ruleset::taiko => (int) round(
                ($objectCount * 1109 + 100000) * $standardisedScore / self::MAX_SCORE,
                mode: PHP_ROUND_HALF_EVEN,
            ),
            Ruleset::catch => (int) round(
                ($standardisedScore / self::MAX_SCORE * $objectCount) ** 2 * 21.62 + $standardisedScore / 10,
                mode: PHP_ROUND_HALF_EVEN,
            ),
            default => $standardisedScore,
        };
    }
}
