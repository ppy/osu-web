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

use App\Models\User;

$factory->define(App\Models\Changelog::class, function (Faker\Generator $faker) {
    $u = User::orderByRaw('RAND()')->first();

    return [
        'user_id' => $u->user_id,
        'prefix' => $faker->randomElement(['*', '+', '?']),
        'category' => $faker->randomElement(['Web', 'Audio', 'Code', 'Editor', 'Gameplay', 'Graphics']),
        'message' => $faker->catchPhrase,
        'checksum' => $faker->md5,
        'date' => $faker->dateTimeBetween($startDate = '-6 weeks', $endDate = 'now'),
    ];
});
