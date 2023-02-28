<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Score;
use App\Models\User;

$factory->define(Score::class, function (Faker\Generator $faker) {
    return [
        'playlist_item_id' => function () {
            return factory(PlaylistItem::class)->create()->getKey();
        },
        'beatmap_id' => function (array $self) {
            return PlaylistItem::find($self['playlist_item_id'])->beatmap_id;
        },
        'room_id' => function (array $self) {
            return PlaylistItem::find($self['playlist_item_id'])->room_id;
        },
        'user_id' => function () {
            return User::factory()->create()->getKey();
        },
        'total_score' => 1,
        'started_at' => now()->subMinutes(5),
        'accuracy' => 0.5,
        'pp' => 1,
    ];
});

$factory->state(Score::class, 'completed', function (Faker\Generator $faker) {
    return [
        'ended_at' => now(),
    ];
});

$factory->state(Score::class, 'passed', function (Faker\Generator $faker) {
    return [
        'passed' => true,
    ];
});

$factory->state(Score::class, 'failed', function (Faker\Generator $faker) {
    return [
        'passed' => false,
    ];
});

$factory->state(Score::class, 'scoreless', function (Faker\Generator $faker) {
    return [
        'total_score' => 0,
    ];
});
