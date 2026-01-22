<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\Beatmap;
use App\Models\Spotlight;
use App\Models\UserStatistics\Spotlight\Model as UserStatisticsModel;
use Carbon\Carbon;
use DB;
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

            $date->addMonths(1);
        }

        collect(range(1, 10))->each(function () {
            $this->seedNonPeriodic();
        });
    }

    public function seedMonthly($date)
    {
        // note: this does result in spotlights with beatmaps from the future.
        DB::transaction(function () use ($date) {
            $spotlight = Spotlight::factory()->monthly()->make([
                'chart_month' => $date,
            ]);

            $spotlight->saveOrExplode();

            static::seedData($spotlight);
        });
    }

    public function seedBestOf($date)
    {
        DB::transaction(function () use ($date) {
            $spotlight = Spotlight::factory()->bestof()->make([
                'chart_month' => $date->copy()->endOfYear(),
            ]);

            $spotlight->saveOrExplode();

            static::seedData($spotlight);
        });
    }

    public function seedNonPeriodic()
    {
        DB::transaction(function () {
            $spotlight = Spotlight::factory()->make();
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

            foreach (Beatmap::MODES as $ruleset => $rulesetId) {
                // beatmaps
                $beatmaps = Beatmap::where('playmode', $rulesetId)->orderByRaw('RAND()')->limit(rand(4, 10))->get();
                $beatmapsetIds = array_unique($beatmaps->pluck('beatmapset_id')->toArray());

                DB::connection('mysql-charts')->table($spotlight->beatmapsetsTableName($ruleset))->insert(
                    array_map(function ($id) {
                        return ['beatmapset_id' => $id];
                    }, $beatmapsetIds)
                );

                foreach ($users as $user) {
                    // user_stats
                    $stats = UserStatisticsModel::getClass($ruleset)::factory()->make(['user_id' => $user]);
                    $stats->setTable($spotlight->userStatsTableName($ruleset));

                    $stats->save();
                }
            }
        });
    }
}
