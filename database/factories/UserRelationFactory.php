<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use App\Models\UserRelation;

$factory->define(UserRelation::class, function (Faker\Generator $faker) {
    return [];
});

$factory->state(UserRelation::class, 'friend', function (Faker\Generator $faker) {
    return ['friend' => true];
});

$factory->state(UserRelation::class, 'block', function (Faker\Generator $faker) {
    return ['foe' => true];
});
