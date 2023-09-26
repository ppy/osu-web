<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Count;
use App\Models\User;
use App\Models\UserStatistics\Model as UserStatisticsModel;
use Tests\TestCase;

class RankingControllerTest extends TestCase
{
    public function testIndex()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu', 'type' => 'performance']))
            ->assertSuccessful();
    }

    public function testIndexRedirect()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu']))
            ->assertRedirect(route('rankings', ['mode' => 'osu', 'type' => 'performance']));
    }

    public function testIndexInvalidMode()
    {
        $this
            ->get(route('rankings', ['mode' => 'nope', 'type' => 'performance']))
            ->assertStatus(404);
    }

    public function testIndexInvalidType()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu', 'type' => 'notatype']))
            ->assertStatus(404);
    }

    public function testRecentRankChange(): void
    {
        $ruleset = 'osu';
        $user = User::factory()
            ->has(
                UserStatisticsModel::getClass($ruleset)::factory()->state(['rank_score_index' => 1]),
                'statistics'.studly_case($ruleset),
            )
            ->create();
        $user->rankHistories()->create([
            'mode' => Beatmap::modeInt($ruleset),
            'r0' => 10001,
        ]);

        // Set the start of the rank history table to r31, so that the recent
        // rank change is taking the difference between current rank and r0
        Count::currentRankStart($ruleset)->update(['count' => 31]);

        $this->actAsScopedUser(null, ['public']);

        $this
            ->getJson(route('api.rankings', ['mode' => $ruleset, 'type' => 'performance']))
            ->assertOk()
            ->assertJsonPath('ranking.0.recent_rank_change', -10000);
    }
}
