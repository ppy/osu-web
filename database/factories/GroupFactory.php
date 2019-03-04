<?php

use App\Models\Group;

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        // try to avoid accidentally granting permissions based on hardcoded group ids
        'group_id' => function () {
            return max(Group::max('group_id'), 40) + 1;
        },
        'group_name' => function () use ($faker) {
            return $faker->colorName().' '.$faker->domainWord();
        },
        'group_desc' => function () use ($faker) {
            return $faker->sentence();
        },
    ];
});
