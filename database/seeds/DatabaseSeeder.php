<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            /** These are variables that are global across all tables **/

            $username = $faker->userName;
            $userid = $faker->numberBetween($min = 1, $max = 9999);
            $beatmapsetid = $faker->numberBetween($min = 1, $max = 1000000);

            /** Creates rows for tables at are outlined in ModelFactory.php. You
            can add custom columns here that were not already outlined in ModelFactory.php
            if you would like to use the same variable for multiple files. **/

            factory(App\Models\User::class)->create([
                'user_id' => $userid,
                'username' => $username,
                'username_clean' => $username
            ]);

            factory(App\Models\BeatmapSet::class)->create([
                'user_id' => $userid,
                'beatmapset_id' => $beatmapsetid,
                'creator' => $username
            ]);

            factory(App\Models\Beatmap::class)->create([
                'user_id' => $userid,
                'beatmapset_id' => $beatmapsetid,
            ]);
        }
    }
}
