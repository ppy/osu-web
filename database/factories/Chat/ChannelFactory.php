<?php

use App\Models\Chat\Channel;

$factory->define(Channel::class, function (Faker\Generator $faker) {
    return [
        'name' => '#'.$faker->colorName,
        'description' => $faker->bs,
    ];
});

$factory->state(Channel::class, 'public', function (Faker\Generator $faker) {
    return ['type' => 'public'];
});

$factory->state(Channel::class, 'private', function (Faker\Generator $faker) {
    return ['type' => 'private'];
});

$factory->state(Channel::class, 'pm', function (Faker\Generator $faker) {
    return ['type' => 'pm'];
});
