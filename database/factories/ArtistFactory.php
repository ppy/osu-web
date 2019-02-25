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
        'cover_url' => function () use ($faker) {
            // #.jpg is a workaround for 'retinaify' failing on lorempixel not providing a file extension
            return $faker->imageUrl(500, 500, 'cats').'#.jpg';
        },
        'header_url' => function () use ($faker) {
            // #.jpg is a workaround for 'retinaify' failing on lorempixel not providing a file extension
            return $faker->imageUrl(1000, 200).'#.jpg';
        },
        'visible' => 1,
    ];
});
