<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\ArtistTrack::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'genre' => $faker->word(),
        'bpm' => rand(100, 200),
        'length' => $faker->randomNumber(3),
        'preview' => $faker->url(),
        'osz' => $faker->url(),
    ];
});
