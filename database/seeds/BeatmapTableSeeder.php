<?php

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BeatmapTableSeeder extends Seeder
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
			
			$faker->seed($i);
			
			$userid = $faker->numberBetween($min = 1, $max = 9999);
			$totallength = $faker->numberBetween($min = 60, $max = 600);
			$hitlength = $totallength - $faker->numberBetween($min = 10, $max = 60);
			$countnormal = $faker->numberBetween($min = 30, $max = 1337);
			$countslider = $faker->numberBetween($min = 30, $max = 1337);
			$countspinner = $faker->numberBetween($min = 0, $max = 0);
			$counttotal = $countnormal + $countslider + $countspinner;
			$playcount = $faker->numberBetween($min = 100, $max = 25000);
			$passcount = $playcount * $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 0.9);
			
			DB::table('osu_beatmaps')->insert([
				'user_id' => $userid,
				'beatmap_id' => $faker->numberBetween($min = 5000, $max = 9999999),
				'beatmapset_id' => $faker->numberBetween($min = 1, $max = 1000000),
				'filename' => $faker->numberBetween($min = 1, $max = 50000),
				'checksum' => $faker->md5,
				'version' => $faker->domainWord,
				'total_length' => $totallength,
				'hit_length' => $hitlength,
				'countTotal' => $counttotal,
				'countNormal' => $countnormal,
				'countSlider' => $countslider,
				'countSpinner' => $countspinner,
				'diff_drain' => $faker->numberBetween($min = 1, $max = 10),
				'diff_size' => $faker->numberBetween($min = 1, $max = 10),
				'diff_overall' => $faker->numberBetween($min = 1, $max = 10),
				'diff_approach' => $faker->numberBetween($min = 1, $max = 10),
				'playmode' => $faker->numberBetween($min = 0, $max = 3),
				'approved' => rand(-2,3),
				'difficultyrating' => $counttotal = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 9),
				'playcount' => $playcount,
				'passcount' => $passcount
			]);
		}
    }
}
