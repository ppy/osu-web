<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Seeders\ModelSeeders;

use App\Models\BanchoStats;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BanchoStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon();

        //Create 500 new data points
        factory(BanchoStats::class, 500)->make()->each(function ($stat) use ($date) {
            $stat->date = $date;
            $stat->save();

            //Increment the dates by 5 each time
            $date->addMinutes(5);
        });
    }
}
