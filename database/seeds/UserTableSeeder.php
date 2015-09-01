<?php

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
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
			
			$username = $faker->firstName;
			
			DB::table('phpbb_users')->insert([
				'user_id' => $faker->numberBetween($min = 1, $max = 9999),
				'username' => $username,
				'username_clean' => $username,
				'user_password' => password_hash(md5($faker->word), PASSWORD_BCRYPT),
			]);
		}
    }
}
