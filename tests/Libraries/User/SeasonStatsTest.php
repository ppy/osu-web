<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Libraries\User\SeasonStats;
use App\Models\Beatmap;
use App\Models\Season;
use App\Models\SeasonDivision;
use App\Models\User;
use App\Models\UserSeasonScoreAggregate;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SeasonStatsTest extends TestCase
{
    private const PARTICIPANT_COUNT = 10;

    private User $user;

    public function testCurrentForBackCompatNullVariant(): void
    {
        $season = $this->createSeason(['ruleset_id' => Beatmap::MODES['mania']]);
        $this->seedRanking($season, userRank: 1);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season->getKey(), $stats['season']['id']);
        $this->assertNull($stats['season']['variant_id']);
    }

    public function testCurrentForPicksLowerDivisionThreshold(): void
    {
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 4,
        ]);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 7,
        ]);
        $this->seedRanking($season4k, userRank: 1);
        $this->seedRanking($season7k, userRank: 5);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season4k->getKey(), $stats['season']['id']);
        $this->assertSame(4, $stats['season']['variant_id']);
    }

    public function testCurrentForSameThresholdPicksLowerRank(): void
    {
        $thresholds = [1.0];
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 4,
        ], $thresholds);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 7,
        ], $thresholds);
        $this->seedRanking($season4k, userRank: 3);
        $this->seedRanking($season7k, userRank: 8);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season4k->getKey(), $stats['season']['id']);
        $this->assertSame(3, $stats['rank']);
    }

    public function testCurrentForSkipsSeasonWithoutUserScore(): void
    {
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 4,
        ]);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant_id' => 7,
        ]);
        $this->seedRanking($season4k);
        $this->seedRanking($season7k, userRank: 5);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season7k->getKey(), $stats['season']['id']);
    }

    public function testCurrentForReturnsNullWithoutQualifyingStats(): void
    {
        $this->createSeason(['ruleset_id' => Beatmap::MODES['mania']]);

        $this->assertNull(SeasonStats::currentFor($this->user, 'mania'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        $this->user = User::factory()->create();
    }

    /**
     * @param float[] $thresholds
     */
    private function createSeason(array $attributes, array $thresholds = [0.1, 1.0]): Season
    {
        $season = Season::factory()->create($attributes);

        foreach ($thresholds as $threshold) {
            SeasonDivision::factory()->create([
                'season_id' => $season,
                'threshold' => $threshold,
            ]);
        }

        return $season;
    }

    private function addScore(Season $season, User $user, float $totalScore): void
    {
        UserSeasonScoreAggregate::create([
            'season_id' => $season->getKey(),
            'total_score' => $totalScore,
            'user_id' => $user->getKey(),
        ]);
    }

    private function seedRanking(Season $season, ?int $userRank = null): void
    {
        for ($rank = 1; $rank <= self::PARTICIPANT_COUNT; $rank++) {
            $user = $rank === $userRank
                ? $this->user
                : User::factory()->create();

            $this->addScore($season, $user, self::PARTICIPANT_COUNT - $rank + 1);
        }
    }
}
