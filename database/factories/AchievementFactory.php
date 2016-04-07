<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Achievement::class, function (Faker\Generator $faker) {
    return  [
        'name' => $faker->catchPhrase,
        'description' => $faker->realText(30),
        'quest_instructions' => $faker->realText(30),        
        'image' => 'http://s.ppy.sh/images/achievements/gamer2.png',
    ];
});
