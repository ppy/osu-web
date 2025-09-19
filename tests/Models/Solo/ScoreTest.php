<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Solo;

use App\Exceptions\InvariantException;
use App\Models\Solo\Score;
use stdClass;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    public function testStatisticsStoredInCorrectCasing()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['Great' => 10, 'SmallTickHit' => 1],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $score = $score->fresh();
        $this->assertSame(1, json_decode($score->getAttributes()['data'], true)['statistics']['small_tick_hit']);
        $this->assertSame(1, $score->data->statistics->small_tick_hit);
    }

    public function testLegacyPassScoreSetsRank()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertTrue($score->passed);
        $this->assertSame($score->rank, 'S');

        $legacy = $score->makeLegacyEntry();

        $this->assertSame($legacy->rank, 'X');
    }

    public function testLegacyFailScoreIsRankF()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => false,
            'rank' => 'S', // lazer may send an incorrect rank for a failed score.
            'ruleset_id' => 1,
            'statistics' => ['great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertFalse($score->passed);
        $this->assertSame($score->rank, 'F');

        $legacy = $score->makeLegacyEntry();

        $this->assertSame($legacy->rank, 'F');
    }

    public function testLegacyScoreHitCounts()
    {
        $legacy = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 0,
            'statistics' => ['great' => 10, 'ok' => 20, 'meh' => 30, 'miss' => 40],
            'total_score' => 1000,
            'user_id' => 1,
        ])->makeLegacyEntry();

        $this->assertSame($legacy->count300, 10);
        $this->assertSame($legacy->count100, 20);
        $this->assertSame($legacy->count50, 30);
        $this->assertSame($legacy->countmiss, 40);
    }

    public function testLegacyScoreHitCountsFromStudlyCaseStatistics()
    {
        $legacy = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 0,
            'statistics' => ['Great' => 10, 'Ok' => 20, 'Meh' => 30, 'Miss' => 40],
            'total_score' => 1000,
            'user_id' => 1,
        ])->makeLegacyEntry();

        $this->assertSame($legacy->count300, 10);
        $this->assertSame($legacy->count100, 20);
        $this->assertSame($legacy->count50, 30);
        $this->assertSame($legacy->countmiss, 40);
    }

    public function testModsPropertyType()
    {
        $score = new Score([
            'beatmap_id' => 0,
            'data' => [
                'mods' => [['acronym' => 'DT']],
            ],
            'ended_at' => json_time(now()),
            'ruleset_id' => 0,
            'user_id' => 0,
        ]);

        $this->assertTrue($score->data->mods[0] instanceof stdClass, 'mods entry should be of type stdClass');
    }

    public function testWeightedPp(): void
    {
        $pp = 10;
        $weight = 0.5;
        $score = Score::factory()->create(['pp' => $pp]);
        $score->weight = $weight;

        $this->assertSame($score->weightedPp(), $pp * $weight);
    }

    public function testWeightedPpWithoutPerformance(): void
    {
        $score = Score::factory()->create(['pp' => null]);
        $score->weight = 0.5;

        $this->assertNull($score->weightedPp());
    }

    public function testWeightedPpWithoutWeight(): void
    {
        $score = Score::factory()->create(['pp' => 10]);

        $this->assertNull($score->weightedPp());
    }

    public function testNegativeTotalScoreIsNotAccepted()
    {
        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('Invalid total_score.');

        Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['Great' => 10, 'SmallTickHit' => 1],
            'total_score' => -1000,
            'user_id' => 1,
        ]);
    }

    public function testNegativeAccuracyIsNotAccepted()
    {
        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('Invalid accuracy.');

        Score::createFromJsonOrExplode([
            'accuracy' => -1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['Great' => 10, 'SmallTickHit' => 1],
            'total_score' => 1000,
            'user_id' => 1,
        ]);
    }

    public function testAccuracyAboveOneIsNotAccepted()
    {
        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('Invalid accuracy.');

        Score::createFromJsonOrExplode([
            'accuracy' => 2,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['Great' => 10, 'SmallTickHit' => 1],
            'total_score' => 1000,
            'user_id' => 1,
        ]);
    }

    public function testNegativeTotalScoreWithoutModsIsNotAccepted()
    {
        $this->expectException(InvariantException::class);
        $this->expectExceptionMessage('Invalid total_score_without_mods.');

        Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => json_time(now()),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['Great' => 10, 'SmallTickHit' => 1],
            'total_score' => 1000,
            'total_score_without_mods' => -1000,
            'user_id' => 1,
        ]);
    }
}
