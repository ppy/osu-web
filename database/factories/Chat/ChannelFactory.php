<?php
/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */
use App\Models\Chat\Channel;

$factory->define(Channel::class, function (Faker\Generator $faker) {
    return [
        'name' => '#'.$faker->colorName,
        'description' => $faker->bs,
    ];
});

$factory->state(Channel::class, 'public', function (Faker\Generator $faker) {
    return ['type' => Channel::TYPES['public']];
});

$factory->state(Channel::class, 'private', function (Faker\Generator $faker) {
    return ['type' => Channel::TYPES['private']];
});

$factory->state(Channel::class, 'pm', function (Faker\Generator $faker) {
    return ['type' => Channel::TYPES['pm']];
});
