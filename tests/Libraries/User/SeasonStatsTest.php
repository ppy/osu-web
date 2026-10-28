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
        $this->seedRanking($season, rank: 1);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season->getKey(), $stats['season']['id']);
        $this->assertNull($stats['season']['variant']);
    }

    public function testCurrentForPicksLowerDivisionThreshold(): void
    {
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '4k',
        ]);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '7k',
        ]);
        $this->seedRanking($season4k, rank: 1);
        $this->seedRanking($season7k, rank: 5);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season4k->getKey(), $stats['season']['id']);
        $this->assertSame('4k', $stats['season']['variant']);
    }

    public function testCurrentForSameThresholdPicksLowerRank(): void
    {
        $thresholds = [1.0];
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '4k',
        ], $thresholds);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '7k',
        ], $thresholds);
        $this->seedRanking($season4k, rank: 3);
        $this->seedRanking($season7k, rank: 8);

        $stats = SeasonStats::currentFor($this->user, 'mania');

        $this->assertSame($season4k->getKey(), $stats['season']['id']);
        $this->assertSame(3, $stats['rank']);
    }

    public function testCurrentForSkipsSeasonWithoutUserScore(): void
    {
        $season4k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '4k',
        ]);
        $season7k = $this->createSeason([
            'ruleset_id' => Beatmap::MODES['mania'],
            'variant' => '7k',
        ]);
        $this->seedRanking($season4k, rank: 1, includeUser: false);
        $this->seedRanking($season7k, rank: 5);

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
        \Cache::flush();
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

    private function seedRanking(Season $season, int $rank, bool $includeUser = true): void
    {
        if ($includeUser) {
            $this->addScore($season, $this->user, self::PARTICIPANT_COUNT - $rank + 1);
        }

        for ($otherRank = 1; $otherRank <= self::PARTICIPANT_COUNT; $otherRank++) {
            if ($includeUser && $otherRank === $rank) {
                continue;
            }

            $this->addScore(
                $season,
                User::factory()->create(),
                self::PARTICIPANT_COUNT - $otherRank + 1,
            );
        }
    }
}
