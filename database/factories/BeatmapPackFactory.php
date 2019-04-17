<?php

$factory->define(App\Models\BeatmapPack::class, function (Faker\Generator $faker) {
    return  [
        'url' => function () use ($faker) {
            return $faker->url();
        },
        'name' => function () use ($faker) {
            return $faker->catchPhrase();
        },
        'author' => function () use ($faker) {
            return $faker->username();
        },
        'tag' => function () use ($faker) {
            return $faker->randomElement(['S', 'T', 'A', 'R']).$faker->numberBetween(10, 100);
        },
        'date' => Carbon\Carbon::now()->subMonths(2),
    ];
});
