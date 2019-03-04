<?php

$factory->define(App\Models\Genre::class, function (Faker\Generator $faker) {
    return  [
        'name' => function () use ($faker) {
            return $faker->colorName();
        },
    ];
});
