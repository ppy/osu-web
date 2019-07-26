<?php

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'message' => function () use ($faker) {
            return $faker->paragraph();
        },
        'commentable_type' => 'build', // TODO: add support for more types
        'commentable_id' => function () {
            return factory(App\Models\Build::class)->create()->build_id;
        },
        'created_at' => Carbon\Carbon::now(),
        'updated_at' => Carbon\Carbon::now(),
    ];
});
