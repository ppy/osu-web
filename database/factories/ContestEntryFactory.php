<?php

$factory->define(App\Models\ContestEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'entry_url' => $faker->imageUrl(256, 256, 'cats'),
        'name' => $faker->words(3, true),
        'masked_name' => $faker->words(3, true),
    ];
});
