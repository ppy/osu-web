<?php

$factory->define(App\Models\Language::class, function (Faker\Generator $faker) {
    return  [
        'name' => function () use ($faker) {
            // 'name' is varchar(50) and some generated strings are longer than that
            return substr($faker->country(), 0, 50);
        },
    ];
});
