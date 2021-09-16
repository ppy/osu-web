<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Multiplayer\PlaylistItem::class, function (Faker\Generator $faker) {
    return [
        'beatmap_id' => function () {
            return factory(App\Models\Beatmap::class)->create()->getKey();
        },
        'room_id' => function () {
            return factory(App\Models\Multiplayer\Room::class)->create()->getKey();
        },
        'ruleset_id' => function (array $self) {
            return App\Models\Beatmap::find($self['beatmap_id'])->playmode;
        },
        'allowed_mods' => [],
        'required_mods' => [],
    ];
});
