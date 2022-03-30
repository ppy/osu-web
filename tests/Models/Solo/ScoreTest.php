<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Solo;

use App\Models\Solo\Score;
use Carbon\Carbon;
use stdClass;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    public function testStatisticsStoredInCorrectCasing()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => Carbon::now(),
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
        $this->assertSame(1, $score->data->statistics->smallTickHit);
    }

    public function testLegacyPassScoreRetainsRank()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => Carbon::now(),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 1,
            'statistics' => ['great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertTrue($score->data->passed);
        $this->assertSame($score->data->rank, 'S');

        $legacy = $score->createLegacyEntryOrExplode();

        $this->assertTrue($legacy->perfect);
        $this->assertSame($legacy->rank, 'S');
    }

    public function testLegacyFailScoreIsRankD()
    {
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => Carbon::now(),
            'max_combo' => 100,
            'mods' => [],
            'passed' => false,
            'rank' => 'S', // lazer may send an incorrect rank for a failed score.
            'ruleset_id' => 1,
            'statistics' => ['great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertFalse($score->data->passed);
        $this->assertSame($score->data->rank, 'D');

        $legacy = $score->createLegacyEntryOrExplode();

        $this->assertFalse($legacy->perfect);
        $this->assertSame($legacy->rank, 'D');
    }

    public function testLegacyScoreHitCounts()
    {
        $legacy = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => 1,
            'ended_at' => Carbon::now(),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 0,
            'statistics' => ['great' => 10, 'ok' => 20, 'meh' => 30, 'miss' => 40],
            'total_score' => 1000,
            'user_id' => 1,
        ])->createLegacyEntryOrExplode();

        $this->assertFalse($legacy->perfect);
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
            'ended_at' => Carbon::now(),
            'max_combo' => 100,
            'mods' => [],
            'passed' => true,
            'rank' => 'S',
            'ruleset_id' => 0,
            'statistics' => ['Great' => 10, 'Ok' => 20, 'Meh' => 30, 'Miss' => 40],
            'total_score' => 1000,
            'user_id' => 1,
        ])->createLegacyEntryOrExplode();

        $this->assertFalse($legacy->perfect);
        $this->assertSame($legacy->count300, 10);
        $this->assertSame($legacy->count100, 20);
        $this->assertSame($legacy->count50, 30);
        $this->assertSame($legacy->countmiss, 40);
    }

    public function testModsPropertyType()
    {
        $score = new Score(['data' => ['mods' => [['acronym' => 'DT']]]]);

        $this->assertTrue($score->data->mods[0] instanceof stdClass, 'mods entry should be of type stdClass');
    }
}
