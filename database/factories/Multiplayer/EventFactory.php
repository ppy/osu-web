<?php

$factory->define(App\Models\Multiplayer\Event::class, function (Faker\Generator $faker) {
    return [
        'match_id' => function () {
            return factory(App\Models\Multiplayer\Match::class)->create()->user_id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'timestamp' => Carbon\Carbon::now(),
    ];
});

$factory->state(App\Models\Multiplayer\Event::class, 'join', function (Faker\Generator $faker) {
    return [
        'text' => 'JOIN',
    ];
});

$factory->state(App\Models\Multiplayer\Event::class, 'part', function (Faker\Generator $faker) {
    return [
        'text' => 'PART',
    ];
});
