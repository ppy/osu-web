<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
        factory(App\Models\BanchoStats::class, 500)->create()->each(function ($stat) use ($date) {
            $stat->date = $date;
            $stat->save();

            //Increment the dates by 5 each time
            $date = $date->addMinutes(5);
        });
    }
}
