<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Users;

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\User;
use App\Models\UserStatistics\Model as UserStatisticsModel;
use Tests\TestCase;

class LookupControllerTest extends TestCase
{
    public function testRulesetLookupIncludesStatistics(): void
    {
        $ruleset = 'taiko';
        $country = 'JP';
        Country::factory()->create(['acronym' => $country]);
        $user = User::factory()->create(['country_acronym' => $country]);
        $higherRankedUser = User::factory()->create(['country_acronym' => $country]);
        $class = UserStatisticsModel::getClass($ruleset);

        $class::factory()->create([
            'country_acronym' => $country,
            'rank_score' => 1000,
            'rank_score_index' => 1,
            'user_id' => $higherRankedUser->getKey(),
        ]);
        $class::factory()->create([
            'country_acronym' => $country,
            'rank_score' => 500,
            'rank_score_index' => 2,
            'user_id' => $user->getKey(),
        ]);

        $this
            ->getJson(route('users.lookup', [
                'ids' => [$user->getKey()],
                'ruleset_id' => Beatmap::MODES[$ruleset],
            ]))
            ->assertOk()
            ->assertJsonPath('users.0.global_rank.rank', 2)
            ->assertJsonPath('users.0.statistics.global_rank', 2)
            ->assertJsonPath('users.0.statistics.country_rank', 2);
    }
}
