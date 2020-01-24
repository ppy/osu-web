<?php

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'group_name' => function () use ($faker) {
            return $faker->colorName().' '.$faker->domainWord();
        },
        'group_desc' => function () use ($faker) {
            return $faker->sentence();
        },
    ];
});
