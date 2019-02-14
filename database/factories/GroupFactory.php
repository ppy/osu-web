<?php

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'group_id' => function () use ($faker) {
            // try to avoid accidentally granting permissions based on hardcoded group ids
            return $faker->numberBetween(40, 100);
        },
        'group_name' => function () use ($faker) {
            return $faker->colorName().' '.$faker->domainWord();
        },
        'group_desc' => function () use ($faker) {
            return $faker->sentence();
        },
    ];
});
