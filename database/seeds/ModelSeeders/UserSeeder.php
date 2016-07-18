<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('phpbb_users')->delete();
        // DB::table('osu_user_stats')->delete();
        // DB::table('osu_user_stats_fruits')->delete();
        // DB::table('osu_user_stats_mania')->delete();
        // DB::table('osu_user_stats_taiko')->delete();
        // DB::table('osu_user_performance_rank')->delete();

        $this->faker = Faker::create();

        // Store some constants
        $this->improvement_speeds = [
            (rand(100, 110) / 100), // Fast Learner
            (rand(100, 102) / 100), // Slow Learner
            (rand(100, 115) / 100), // Genius / Multiaccounter :P
        ];
        $this->common_countries = ['US', 'JP', 'CN', 'DE', 'TW', 'RU', 'KR', 'PL', 'CA', 'FR', 'BR', 'GB', 'AU'];

        // Create 10 users and their stats
        factory(App\Models\User::class, 10)->create()->each(function ($u) {

            // USER STATS
            $country_code = array_rand_val($this->common_countries);

            $rank0 = rand(1, 500000);
            $rank1 = rand(1, 500000);
            $rank2 = rand(1, 500000);
            $rank3 = rand(1, 500000);
            $st = $u->statisticsOsu()->save(factory(App\Models\UserStatistics\Osu::class)->create(['country_acronym' => $country_code, 'rank' => $rank0, 'rank_score_index' => $rank0]));
            $st1 = $u->statisticsOsu()->save(factory(App\Models\UserStatistics\Taiko::class)->create(['country_acronym' => $country_code, 'rank' => $rank1, 'rank_score_index' => $rank1]));
            $st2 = $u->statisticsOsu()->save(factory(App\Models\UserStatistics\Fruits::class)->create(['country_acronym' => $country_code, 'rank' => $rank2, 'rank_score_index' => $rank2]));
            $st3 = $u->statisticsOsu()->save(factory(App\Models\UserStatistics\Mania::class)->create(['country_acronym' => $country_code, 'rank' => $rank3, 'rank_score_index' => $rank3]));
            // END USER STATS

            // RANK HISTORY

            // Create rank histories for all 4 modes
            for ($c = 0; $c <= 3; $c++) {
                switch ($c) {
                    case 0: $rank = $st->rank; break;
                    case 1: $rank = $st1->rank; break;
                    case 2: $rank = $st2->rank; break;
                    case 3: $rank = $st3->rank; break;
                    default: $rank = $st->rank;
                }

                $hist = new App\Models\RankHistory;

                $hist->mode = $c; // 0 = standard, 1 = taiko etc...

                $play_freq = rand(10, 35); // How regulary the user plays (as a % chance per day)

                // Start with current rank, and move down (back in time) to r0
                $hist->r89 = $rank;

                for ($i = 88; $i >= 0; $i--) {
                    $r = 'r'.$i;
                    $prev_r = 'r'.($i + 1);
                    $prev_rank = $hist->$prev_r;
                    // We wouldn't expect the user to improve every day
                    $does_improve = $this->faker->boolean($play_freq);
                    if ($does_improve === true) {
                        $extreme_improvement = $this->faker->boolean(2); // chance of extreme improvement today
                        if ($extreme_improvement === true) {
                            $improvement_modifier = 1.5;
                        } else {
                            $improvement_modifier = array_rand_val($this->improvement_speeds);
                        }
                        $new_rank = round($hist->$prev_r * $improvement_modifier);
                        if ($new_rank < 1) {
                            $new_rank = 1;
                        }
                        $hist->$r = $new_rank;
                    } else {
                        $new_rank = round($hist->$prev_r * (rand(998, 999) / 1000));
                        if ($new_rank < 1) {
                            $new_rank = 1;
                        }
                        $hist->$r = $new_rank; // Slight decay
                    }
                }
                $u->rankHistories()->save($hist);
            }
            // END RANK HISTORY

            // USER GROUP
            $u->userGroups()->save(new App\Models\UserGroup(['group_id' => App\Models\UserGroup::GROUPS['default']]));
        }); // end each user
    }
}
