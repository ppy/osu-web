<?php

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
        factory(App\Models\BanchoStats::class, 500)->make()->each(function ($stat) use ($date) {
            $stat->date = $date;
            $stat->save();

            //Increment the dates by 5 each time
            $date->addMinutes(5);
        });
    }
}
