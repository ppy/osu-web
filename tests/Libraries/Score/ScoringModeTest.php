<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Score;

use App\Enums\Ruleset;
use App\Models\Solo\Score;
use Tests\TestCase;

class ScoringModeTest extends TestCase
{
    /**
     * @see https://github.com/ppy/osu/blob/b535f7c51916ed09231b78aa422e6488cf9a2a12/osu.Game.Tests/Rulesets/Scoring/ScoreProcessorTest.cs#L77-L102 Client reference
     */
    public static function classicScoreConversionDataProvider(): array
    {
        return [
            [0, 0, 'great'],
            [34_734, 3_492, 'great'],
            [69_925, 7_029, 'great'],
            [154_499, 15_530, 'perfect'],
            [326_963, 32_867, 'great'],
            [326_963, 32_867, 'perfect'],
            [0, 0, 'small_tick_hit'],
            [493_652, 49_365, 'small_tick_hit'],
            [0, 0, 'large_tick_hit'],
            [326_963, 32_696, 'large_tick_hit'],
            [371_627, 37_163, 'slider_tail_hit'],
            [1_000_030, 100_003, 'small_bonus'],
            [1_000_150, 100_015, 'large_bonus'],
        ];
    }

    /**
     * @dataProvider classicScoreConversionDataProvider
     */
    public function testConvertToClassic(int $standardisedScore, int $classicScore, string $maxHitResult): void
    {
        // Hardcoded by the referenced test
        static $maxHitResultCount = 4;
        static $ruleset = Ruleset::osu;

        $score = Score::factory()
            ->withData(['maximum_statistics' => [$maxHitResult => $maxHitResultCount]])
            ->make(['ruleset_id' => $ruleset->value, 'total_score' => $standardisedScore]);

        $this->assertSame($classicScore, $score->getClassicTotalScore());
    }
}
