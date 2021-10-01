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
            'statistics' => ['Great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertTrue($score->data->passed);
        $this->assertEquals($score->data->rank, 'S');

        $legacy = $score->createLegacyEntryOrExplode();

        $this->assertTrue($legacy->perfect);
        $this->assertEquals($legacy->rank, 'S');
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
            'statistics' => ['Great' => 10],
            'total_score' => 1000,
            'user_id' => 1,
        ]);

        $this->assertFalse($score->data->passed);
        $this->assertEquals($score->data->rank, 'D');

        $legacy = $score->createLegacyEntryOrExplode();

        $this->assertFalse($legacy->perfect);
        $this->assertEquals($legacy->rank, 'D');
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
            'statistics' => ['Great' => 10, 'Ok' => 20, 'Meh' => 30, 'Miss' => 40],
            'total_score' => 1000,
            'user_id' => 1,
        ])->createLegacyEntryOrExplode();

        $this->assertFalse($legacy->perfect);
        $this->assertEquals($legacy->count300, 10);
        $this->assertEquals($legacy->count100, 20);
        $this->assertEquals($legacy->count50, 30);
    }

    public function testModsPropertyType()
    {
        $score = new Score(['data' => (object) ['mods' => [new stdClass()]]]);

        $this->assertTrue($score->data->mods[0] instanceof stdClass, 'mods entry should be of type stdClass');
    }
}
