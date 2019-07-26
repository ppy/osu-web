<?php

$factory->define(App\Models\UpdateStream::class, function (Faker\Generator $faker) {
    return  [
        'name' => function () use ($faker) {
            return $faker->colorName();
        },
        'pretty_name' => function () use ($faker) {
            return $faker->colorName();
        },
    ];
});
