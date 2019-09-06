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

$factory->state(App\Models\Multiplayer\Event::class, 'create', function (Faker\Generator $faker) {
    return [
        'user_id' => null,
        'text' => 'CREATE',
    ];
});

$factory->state(App\Models\Multiplayer\Event::class, 'disband', function (Faker\Generator $faker) {
    return [
        'user_id' => null,
        'text' => 'DISBAND',
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

$factory->state(App\Models\Multiplayer\Event::class, 'game', function (Faker\Generator $faker) {
    return [
        'text' => 'test game',
        'user_id' => null,
        'game_id' => function () {
            return factory(App\Models\Multiplayer\Game::class)->states('in_progress')->create()->game_id;
        },
    ];
});
