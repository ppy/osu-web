<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'message' => function () use ($faker) {
            return $faker->paragraph();
        },
        'commentable_type' => function () {
            return 'build'; // TODO: add support for more types
        },
        'commentable_id' => fn () => App\Models\Build::factory()->create()->getKey(),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

$factory->state(App\Models\Comment::class, 'deleted', function () {
    return [
        'deleted_at' => now(),
    ];
});
