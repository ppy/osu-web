<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
