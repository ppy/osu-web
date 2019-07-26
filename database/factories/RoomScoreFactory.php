<?php

$factory->define(App\Models\Multiplayer\RoomScore::class, function (Faker\Generator $faker) {
    return  [
        'playlist_item_id' => function () {
            return factory(App\Models\Multiplayer\PlaylistItem::class)->create()->getKey();
        },
        'beatmap_id' => function (array $self) {
            return App\Models\Multiplayer\PlaylistItem::find($self['playlist_item_id'])->beatmap_id;
        },
        'room_id' => function () {
            return factory(App\Models\Multiplayer\Room::class)->create()->getKey();
        },
        'total_score' => 1,
        'started_at' => Carbon\Carbon::now()->subMinutes(5),
        'accuracy' => 0.5,
        'pp' => 1,
    ];
});

$factory->state(App\Models\Multiplayer\RoomScore::class, 'completed', function (Faker\Generator $faker) {
    return [
        'ended_at' => Carbon\Carbon::now(),
    ];
});

$factory->state(App\Models\Multiplayer\RoomScore::class, 'passed', function (Faker\Generator $faker) {
    return [
        'passed' => true,
    ];
});

$factory->state(App\Models\Multiplayer\RoomScore::class, 'failed', function (Faker\Generator $faker) {
    return [
        'passed' => false,
    ];
});

$factory->state(App\Models\Multiplayer\RoomScore::class, 'scoreless', function (Faker\Generator $faker) {
    return [
        'total_score' => 0,
    ];
});
