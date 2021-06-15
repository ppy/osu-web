<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Build;
use App\Models\BuildPropagationHistory;
use App\Models\Changelog;
use App\Models\UpdateStream;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChangelogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fallback = UpdateStream::firstOrCreate(
            ['stream_id' => 1],
            ['name' => 'stable'],
            ['pretty_name' => 'Stable Fallback']
        );

        $stable = UpdateStream::firstOrCreate(
            ['stream_id' => 5],
            ['name' => 'stable40'],
            ['pretty_name' => 'Stable']
        );

        $builds = factory(Build::class, 20)->create(['stream_id' => $stable->stream_id])
            ->merge(factory(Build::class, 5)->create(['stream_id' => $fallback->stream_id]));

        foreach ($builds as $build) {
            factory(Changelog::class, 5)->create([
                'build' => $build->version,
                'stream_id' => $build->stream_id,
            ]);
        }

        // create some buildless changes
        factory(Changelog::class, 15)->create([
            'build' => null,
            'stream_id' => 5,
        ]);

        factory(Changelog::class, 5)->create([
            'build' => null,
            'stream_id' => 1,
        ]);

        $date = Carbon::now()->subDays(7);

        for ($i = 0; $i < 336; $i++) { // 336 30-minute intervals is 7 days
            foreach ($builds as $build) {
                BuildPropagationHistory::create([
                    'build_id' => $build->build_id,
                    'user_count' => rand(100, 10000),
                    'created_at' => $date,
                ]);
            }

            $date->addMinutes(30);
        }
    }
}
