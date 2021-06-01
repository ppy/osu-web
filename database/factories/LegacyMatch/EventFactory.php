<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\LegacyMatch\Event;
use App\Models\LegacyMatch\Game;
use App\Models\LegacyMatch\LegacyMatch;

$factory->define(Event::class, function (Faker\Generator $faker) {
    return [
        'match_id' => function () {
            return factory(LegacyMatch::class)->create()->user_id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'timestamp' => Carbon\Carbon::now(),
    ];
});

$factory->state(Event::class, 'create', function (Faker\Generator $faker) {
    return [
        'user_id' => null,
        'text' => 'CREATE',
    ];
});

$factory->state(Event::class, 'disband', function (Faker\Generator $faker) {
    return [
        'user_id' => null,
        'text' => 'DISBAND',
    ];
});

$factory->state(Event::class, 'join', function (Faker\Generator $faker) {
    return [
        'text' => 'JOIN',
    ];
});

$factory->state(Event::class, 'part', function (Faker\Generator $faker) {
    return [
        'text' => 'PART',
    ];
});

$factory->state(Event::class, 'game', function (Faker\Generator $faker) {
    return [
        'text' => 'test game',
        'user_id' => null,
        'game_id' => function () {
            return factory(Game::class)->states('in_progress')->create()->game_id;
        },
    ];
});
