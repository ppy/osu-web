<?php

$factory->define(App\Models\Multiplayer\Room::class, function (Faker\Generator $faker) {
    return  [
        'user_id' => function (array $self) {
            return factory(App\Models\User::class)->create()->getKey();
        },
        'name' => function () use ($faker) {
            return $faker->realText(20);
        },
        'starts_at' => Carbon\Carbon::now()->subHour(1),
        'ends_at' => Carbon\Carbon::now()->addHour(1),
    ];
});

$factory->state(App\Models\Multiplayer\Room::class, 'ended', function (Faker\Generator $faker) {
    return [
        'ends_at' => Carbon\Carbon::now()->subMinute(1),
    ];
});
