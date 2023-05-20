<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\Beatmap;
use App\Models\Country;
use App\Models\RankHistory;
use App\Models\User;
use App\Models\UserAccountHistory;
use App\Models\UserStatistics;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Store some constants
        $improvementSpeeds = [
            rand(100, 102) / 100, // Slow Learner
            rand(102, 110) / 100, // Fast Learner
            rand(110, 115) / 100, // Genius / Multiaccounter :P
        ];

        // Create up to 10 countries for the users
        Country::factory()->count(max(10 - Country::count(), 0))->create();

        // Create 10 users and their stats
        foreach (User::factory()->count(10)->create(['osu_subscriber' => 1]) as $u) {
            // Create statistics and rank histories for all 4 modes
            foreach (Beatmap::MODES as $ruleset => $rulesetId) {
                $rank = rand(1, 500000);
                UserStatistics\Model::getClass($ruleset)::factory()->make([
                    'rank' => $rank,
                    'rank_score_index' => $rank,
                    'user_id' => $u,
                ]);

                $hist = new RankHistory(['mode' => $rulesetId]);

                $playFreq = rand(10, 35); // How regularly the user plays (as a % chance per day)

                // Start with current rank, and move down (back in time) to r0
                $hist->r89 = $rank;
                for ($i = 88; $i >= 0; $i--) {
                    $r = 'r'.$i;
                    $prevR = 'r'.($i + 1);
                    // We wouldn't expect the user to improve every day
                    if (rand(1, 100) < $playFreq) {
                        $rankChange = rand(1, 4) === 1
                            // Extreme improvement today
                            ? 1.5
                            : array_rand_val($improvementSpeeds);
                    } else {
                        // Slight decay
                        $rankChange = rand(998, 999) / 1000;
                    }
                    $hist->$r = max(1, round($hist->$prevR * $rankChange));
                }
                $u->rankHistories()->save($hist);
            }

            // silence
            UserAccountHistory::factory()->silence()->create(['user_id' => $u]);

            // note
            UserAccountHistory::factory()->note()->create(['user_id' => $u]);
        }
    }
}
