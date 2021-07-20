<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Solo;

use App\Exceptions\InvariantException;
use App\Models\Solo\Score;
use Carbon\Carbon;
use stdClass;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    public function testCreateLegacyEntryIncompletePlay()
    {
        $score = new Score();

        $this->expectException(InvariantException::class);

        $score->createLegacyEntry();
    }

    public function testLegacyPassScoreRetainsRank()
    {
        $score = new Score([
            'mods' => [],
            'user_id' => 1,
            'beatmap_id' => 1,
            'ruleset_id' => 1,
        ]);

        $score->complete([
            'ended_at' => Carbon::now(),
            'passed' => true,
            'total_score' => 1000,
            'max_combo' => 100,
            'statistics' => ['Great' => 10],
            'accuracy' => 1,
            'rank' => 'S',
        ]);

        $this->assertTrue($score->passed);
        $this->assertEquals($score->rank, 'S');

        $legacy = $score->createLegacyEntry();

        $this->assertTrue($legacy->perfect);
        $this->assertEquals($legacy->rank, 'S');
    }

    public function testLegacyFailScoreIsRankF()
    {
        $score = new Score([
            'mods' => [],
            'user_id' => 1,
            'beatmap_id' => 1,
            'ruleset_id' => 1,
        ]);

        $score->complete([
            'ended_at' => Carbon::now(),
            'passed' => false,
            'total_score' => 1000,
            'max_combo' => 100,
            'statistics' => ['Great' => 10],
            'accuracy' => 1,
            'rank' => 'S', // lazer may send an incorrect rank for a failed score.
        ]);

        $this->assertFalse($score->passed);
        $this->assertEquals($score->rank, 'F');

        $legacy = $score->createLegacyEntry();

        $this->assertFalse($legacy->perfect);
        $this->assertEquals($legacy->rank, 'F');
    }

    public function testModsPropertyType()
    {
        $score = new Score(['mods' => [new stdClass()]]);

        $this->assertTrue($score->mods[0] instanceof stdClass, 'mods entry should be of type stdClass');
    }
}
