<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Beatmap;
use App\Models\Tournament;
use App\Models\User;
use App\Models\UserStatistics;
use Tests\TestCase;

class TournamentTest extends TestCase
{
    public function testTournamentUserIsValidRank()
    {
        $user = User::factory()->create();
        $playModeInt = Beatmap::MODES['osu'];
        $tournament = factory(Tournament::class)->create([
            'play_mode' => $playModeInt,
            'rank_min' => 1,
            'rank_max' => 100,
        ]);

        $stats = $user->statisticsOsu()->create([
            'rank_score_index' => $tournament->rank_max + 1,
            'rank_score' => 1,
        ]);

        $this->assertFalse($tournament->isValidRank($user->fresh()));

        $stats->update(['rank_score_index' => $tournament->rank_max]);

        $this->assertTrue($tournament->isValidRank($user->fresh()));
    }

    public function testTournamentUserIsValidRankWithVariant()
    {
        $user = User::factory()->create();
        $playModeInt = Beatmap::MODES['mania'];
        $playModeVariant = Beatmap::VARIANTS['mania'][0];
        $tournament = factory(Tournament::class)->create([
            'play_mode' => $playModeInt,
            'play_mode_variant' => $playModeVariant,
            'rank_min' => 1,
            'rank_max' => 100,
        ]);

        $user->statisticsMania()->create([
            'rank_score_index' => $tournament->rank_max,
            'rank_score' => 1,
        ]);

        $this->assertFalse($tournament->isValidRank($user->fresh()));

        $stats = UserStatistics\Model
            ::getClass('mania', $playModeVariant)
            ::create([
                'user_id' => $user->getKey(),
                'rank_score_index' => $tournament->rank_max + 1,
                'rank_score' => 1,
            ]);

        $this->assertFalse($tournament->isValidRank($user->fresh()));

        $stats->update(['rank_score_index' => $tournament->rank_max]);

        $this->assertTrue($tournament->isValidRank($user->fresh()));
    }
}
