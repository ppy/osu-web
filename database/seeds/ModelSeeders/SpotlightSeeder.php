<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Beatmap;
use App\Models\Score\Best\Model as ScoresBestModel;
use App\Models\Spotlight;
use App\Models\UserStatistics\Spotlight\Model as UserStatisticsModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SpotlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::parse('3 years ago')->startOfMonth();
        $now = Carbon::now()->startOfMonth();
        while ($date <= $now) {
            $this->seedMonthly($date);
            if ($date->month === 12) {
                $this->seedBestOf($date);
            }

            $date->addMonth(1);
        }

        collect(range(1, 10))->each(function () {
            $this->seedNonPeriodic();
        });
    }

    public function seedMonthly($date)
    {
        // note: this does result in spotlights with beatmaps from the future.
        DB::transaction(function () use ($date) {
            $spotlight = factory(Spotlight::class)->states('monthly')->make([
                'chart_month' => $date,
            ]);

            $spotlight->saveOrExplode();

            static::seedData($spotlight);
        });
    }

    public function seedBestOf($date)
    {
        DB::transaction(function () use ($date) {
            $spotlight = factory(Spotlight::class)->states('bestof')->make([
                'chart_month' => $date->copy()->endOfYear(),
            ]);

            $spotlight->saveOrExplode();

            static::seedData($spotlight);
        });
    }

    public function seedNonPeriodic()
    {
        DB::transaction(function () {
            $spotlight = factory(Spotlight::class)->make();
            $spotlight->saveOrExplode();

            static::seedData($spotlight);
        });
    }

    private static function seedData($spotlight)
    {
        DB::connection('mysql-charts')->transaction(function () use ($spotlight) {
            $spotlight->createTables();

            // users
            $users = User::orderByRaw('RAND()')->limit(1000)->get();

            foreach (Beatmap::MODES as $mode => $v) {
                // beatmaps
                $beatmaps = Beatmap::where('playmode', $v)->orderByRaw('RAND()')->limit(rand(4, 10))->get();
                $beatmapsetIds = array_unique($beatmaps->pluck('beatmapset_id')->toArray());

                DB::connection('mysql-charts')->table($spotlight->beatmapsetsTableName($mode))->insert(
                    array_map(function ($id) {
                        return ['beatmapset_id' => $id];
                    }, $beatmapsetIds)
                );

                foreach ($users as $user) {
                    // user_stats
                    $stats = factory(UserStatisticsModel::getClass($mode))->make(['user_id' => $user->user_id]);
                    $stats->setTable($spotlight->userStatsTableName($mode));

                    $stats->save();

                    // scores
                    $scoresClass = ScoresBestModel::getClass($v);
                    $possible_ranks = ['A', 'S', 'B', 'SH', 'XH', 'X'];

                    foreach ($beatmaps as $beatmap) {
                        $maxcombo = rand(1, $beatmap->countNormal);
                        $score = new $scoresClass([
                            'user_id' => $user->user_id,
                            'beatmap_id' => $beatmap->beatmap_id,
                            'beatmapset_id' => $beatmap->beatmapset_id,
                            'score' => rand(50000, 100000000),
                            'maxcombo' => $maxcombo,
                            'rank' => array_rand_val($possible_ranks),
                            'count300' => round($maxcombo * 0.8),
                            'count100' => rand(0, round($maxcombo * 0.15)),
                            'count50' => rand(0, round($maxcombo * 0.05)),
                            'countgeki' => round($maxcombo * 0.3),
                            'countmiss' => round($maxcombo * 0.05),
                            'countkatu' => round($maxcombo * 0.05),
                            'date' => rand($spotlight->start_date->timestamp, $spotlight->end_date->timestamp),
                        ]);

                        $score->setConnection('mysql-charts');
                        $score->setTable($spotlight->bestScoresTableName($mode));
                        $score->save();
                    }
                }
            }
        });
    }
}
