<?php

$factory->define(App\Models\Multiplayer\Match::class, function (Faker\Generator $faker) {
    return [
        'name' => function () use ($faker) {
            return $faker->sentence();
        },
        'start_time' => Carbon\Carbon::now(),
        'private' => 0,
    ];
});
