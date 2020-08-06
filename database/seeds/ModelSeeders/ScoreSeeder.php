<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('osu_scores')->delete();
        // DB::table('osu_scores_high')->delete();
        // DB::table('osu_scores_taiko')->delete();
        // DB::table('osu_scores_taiko_high')->delete();
        // DB::table('osu_scores_fruits')->delete();
        // DB::table('osu_scores_fruits_high')->delete();

        $beatmaps = App\Models\Beatmap::orderByRaw('RAND()')->get();
        $beatmapCount = count($beatmaps);
        if ($beatmapCount === 0) {
            $this->command->info('Can\'t seed Scores due to having no beatmap data.');

            return;
        }
        $faker = Faker::create();

        $users = App\Models\User::all();
        App\Models\Score\Model::unguard();

        $allBeatmapsets = App\Models\Beatmapset::all();

        $possible_ranks = ['A', 'S', 'B', 'SH', 'XH', 'X'];

        foreach ($users as $k => $u) {
            $osuBeatmaps = $beatmaps->where('playmode', 0)->take(20);
            $taikoBeatmaps = $beatmaps->where('playmode', 1)->take(20);
            $fruitsBeatmaps = $beatmaps->where('playmode', 2)->take(20);
            $maniaBeatmaps = $beatmaps->where('playmode', 3)->take(20);

            //add 20 osu! Standard scores
            foreach ($osuBeatmaps as $bm) {
                $bms = $allBeatmapsets->find($bm->beatmapset_id);
                $maxcombo = rand(1, $bm->countNormal);
                $possible_mods = [0, 16, 24, 64, 72]; // hr, hd/hr, dt, hd/dt
                $sc = App\Models\Score\Osu::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'beatmapset_id' => $bm->beatmapset_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pass' => $faker->boolean(85), //85% chance of pass
                    'rank' => array_rand_val($possible_ranks),
                    'scorechecksum' => '',
                ]);

                $sc2 = App\Models\Score\Best\Osu::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pp' => $faker->biasedNumberBetween(10, 100) * 1.5 * $bm->difficultyrating,
                    'rank' => array_rand_val($possible_ranks),
                ]);
            }

            //Taiko scores
            foreach ($taikoBeatmaps as $bm) {
                $bms = $allBeatmapsets->find($bm->beatmapset_id);
                $maxcombo = rand(1, $bm->countNormal);
                $possible_mods = [0, 16, 24, 64, 72];
                $sc3 = App\Models\Score\Taiko::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'beatmapset_id' => $bm->beatmapset_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pass' => $faker->boolean(85), //85% chance of pass
                    'rank' => array_rand_val($possible_ranks),
                    'scorechecksum' => '',
                ]);

                $sc4 = App\Models\Score\Best\Taiko::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'rank' => array_rand_val($possible_ranks),
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pp' => $faker->biasedNumberBetween(10, 100) * 1.3 * $bm->difficultyrating,
                ]);
            } // end taiko

            //Fruits scores
            foreach ($fruitsBeatmaps as $bm) {
                $bms = $allBeatmapsets->find($bm->beatmapset_id);
                $maxcombo = rand(1, $bm->countNormal);
                $possible_mods = [0, 16, 24, 64, 72];
                $sc5 = App\Models\Score\Fruits::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'beatmapset_id' => $bm->beatmapset_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'rank' => array_rand_val($possible_ranks),
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pass' => $faker->boolean(85), //85% chance of pass
                    'scorechecksum' => '',
                ]);

                $sc6 = App\Models\Score\Best\Fruits::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'rank' => array_rand_val($possible_ranks),
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()),
                    'pp' => $faker->biasedNumberBetween(10, 100) * 1.3 * $bm->difficultyrating,
                ]);
            } // end fruits

            //Mania scores
            foreach ($maniaBeatmaps as $bm) {
                $bms = $allBeatmapsets->find($bm->beatmapset_id);
                $maxcombo = rand(1, $bm->countNormal);
                $possible_mods = [0, 16, 24, 64, 72]; // hr, hd/hr, dt, hd/dt
                $sc7 = App\Models\Score\Mania::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'beatmapset_id' => $bm->beatmapset_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'rank' => array_rand_val($possible_ranks),
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pass' => $faker->boolean(85), //85% chance of pass
                    'scorechecksum' => '',
                ]);

                $sc8 = App\Models\Score\Best\Mania::create([
                    'user_id' => $u->user_id,
                    'beatmap_id' => $bm->beatmap_id,
                    'score' => rand(50000, 100000000),
                    'maxcombo' => $maxcombo,
                    'rank' => array_rand_val($possible_ranks),
                    'count300' => round($maxcombo * 0.8),
                    'count100' => rand(0, round($maxcombo * 0.15)),
                    'count50' => rand(0, round($maxcombo * 0.05)),
                    'countgeki' => round($maxcombo * 0.3),
                    'countmiss' => round($maxcombo * 0.05),
                    'countkatu' => round($maxcombo * 0.05),
                    'enabled_mods' => array_rand_val($possible_mods),
                    'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
                    'pp' => $faker->biasedNumberBetween(10, 100) * 2 * $bm->difficultyrating,
                ]);
            } // end mania
        }
        App\Models\Score\Model::reguard();
    }
}
