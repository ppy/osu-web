<?php

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BeatmapsetTableSeeder extends Seeder
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
			
			$username = $faker->userName;
			$userid = $faker->numberBetween($min = 1, $max = 9999);
			$beatmapsetid = $faker->numberBetween($min = 1, $max = 1000000);
			$artist = $faker->domainWord;
			$title = $faker->realText($maxNbChars = 20, $indexSize = 5);
			$displaytitle = ucfirst($artist) . " - " . str_replace(".", "", $title);
			
			DB::table('osu_beatmapsets')->insert([
				'beatmapset_id' => $beatmapsetid,
				'user_id' => $userid,
				'thread_id' => $faker->numberBetween($min = 1, $max = 9999),
				'artist' => $artist,
				'title' => $title,
				'creator' => $username,
				'tags' => $faker->userName.",".$faker->word.",".$faker->cityPrefix.",".$faker->streetName.",".$faker->userName.",".$faker->word.",".$faker->domainWord,
				'storyboard' => $faker->numberBetween($min = 0, $max = 1),
				'epilepsy' => $faker->numberBetween($min = 0, $max = 1),
				'bpm' => $faker->numberBetween($min = 170, $max = 240),
				'approved' => rand(-2,3),
				'filename' => $faker->domainWord,
				'rating' => $faker->numberBetween($min = 1, $max = 9),
				'displaytitle' => $displaytitle,
				'genre_id' => $faker->numberBetween($min = 0, $max = 6),
				'language_id' => $faker->numberBetween($min = 0, $max = 6),
				'star_priority' => $faker->numberBetween($min = 0, $max = 6),
				'filesize' => $faker->numberBetween($min = 1000, $max = 999999),
				'favourite_count' => $faker->numberBetween($min = 1, $max = 5000),
				'play_count' => $faker->numberBetween($min = 500, $max = 999999),
				'difficulty_names' => ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord),
			]);
		}
    }
}