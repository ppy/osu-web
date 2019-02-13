<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'group_id'  => function () use ($faker) {
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
