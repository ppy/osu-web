<?php
/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
use App\Models\Chat\Channel;
use App\Models\Multiplayer\Match;

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

$factory->state(Channel::class, 'tourney', function (Faker\Generator $faker) {
    $match = factory(Match::class)->states('tourney')->create();

    return [
        'name' => "#mp_{$match->match_id}",
        'type' => Channel::TYPES['temporary'],
    ];
});
