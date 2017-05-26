<?php

use App\Models\BuildPropagationHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BuildPropagationHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $builds = factory(App\Models\Build::class, 50)->create();
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
