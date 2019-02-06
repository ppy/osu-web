<?php

$factory->define(App\Models\Language::class, function (Faker\Generator $faker) {
    return  [
        'name' => function () use ($faker) {
            return $faker->country();
        },
    ];
});
