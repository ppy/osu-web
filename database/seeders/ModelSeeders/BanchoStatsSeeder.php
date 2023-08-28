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
     */
    public function run(): void
    {
        $timestamp = Carbon::now();

        // Create 500 new data points
        for ($i = 0; $i < 500; $i++) {
            BanchoStats::factory()->create(['date' => $timestamp]);

            // Increment the timestamp by 5 each time
            $timestamp->addMinutes(5);
        }
    }
}
