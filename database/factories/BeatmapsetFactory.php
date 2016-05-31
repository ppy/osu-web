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

$factory->define(App\Models\Beatmapset::class, function (Faker\Generator $faker) {
    $artist = $faker->name;
    $title = $faker->sentence(rand(0, 5));
    $isApproved = (rand(0, 2) > 0);

    return  [
        'creator' => $faker->userName,
        'artist' => $artist,
        'title' => $title,
        'displaytitle' => "{$artist}|{$title}",
        'source' => $faker->domainWord,
        'tags' => $faker->domainWord,
        'bpm' => rand(100, 200),
        'approved' => $isApproved,
        'approved_date' => $isApproved ? Carbon\Carbon::now() : null,
        'play_count' => rand(0, 50000),
        'favourite_count' => rand(0, 500),
        'approved_date' => $faker->dateTime(),
        'submit_date' => $faker->dateTime(),
    ];
});
