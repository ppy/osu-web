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
        $faker = Faker\Factory::create();
        $date = new Carbon();

        for ($i = 0; $i < 500; $i++) {
            $stat = new \App\Models\BanchoStats;
            $stat->users_irc = (100 + $faker->randomNumber(2));
            $stat->users_osu = (10000 + $faker->randomNumber(4));
            $stat->multiplayer_games = (200 + $faker->randomNumber(3));
            $stat->date = $date;
            $stat->save();

            //Increase the date
            $date = $date->addMinutes(5);
        }
    }
}
