<?php

$factory->define(App\Models\Artist::class, function (Faker\Generator $faker) {
    return  [
        'name' => function () use ($faker) {
            return $faker->lastName().' '.$faker->colorName();
        },
        'description' => function () use ($faker) {
            return $faker->realText();
        },
        'website' => function () use ($faker) {
            return $faker->safeEmailDomain();
        },
        'cover_url' => '/images/headers/generic.jpg',
        'header_url' => '/images/headers/generic.jpg',
        'visible' => 1,
    ];
});
