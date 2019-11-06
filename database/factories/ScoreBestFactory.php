<?php

use App\Models\Score\Best\Osu;

$factory->define(App\Models\Score\Best\Osu::class, function (Faker\Generator $faker) {
    $beatmap = factory(App\Models\Beatmap::class)->create([
        'playmode' => 0, // force osu playmode to match score type
    ]);
    $maxCombo = rand(1, $beatmap->countTotal);

    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'beatmap_id' => $beatmap->beatmap_id,
        'score' => rand(50000, 100000000),
        'maxcombo' => $maxCombo,
        'count300' => round($maxCombo * 0.8),
        'count100' => rand(0, round($maxCombo * 0.15)),
        'count50' => rand(0, round($maxCombo * 0.05)),
        'countgeki' => round($maxCombo * 0.3),
        'countmiss' => round($maxCombo * 0.05),
        'countkatu' => round($maxCombo * 0.05),
        'enabled_mods' => array_rand_val([0, 16, 24, 64, 72]),
        'date' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now,
        'pp' => function () use ($faker, $beatmap) {
            return $faker->biasedNumberBetween(10, 100) * 1.5 * $beatmap->difficultyrating;
        },
        'rank' => array_rand_val(['A', 'S', 'B', 'SH', 'XH', 'X']),
    ];
});

$factory
    ->state(App\Models\Score\Best\Osu::class, 'with_replay', function (Faker\Generator $faker) {
        return [
            'replay' => true,
        ];
    })
    ->afterCreatingState(App\Models\Score\Best\Osu::class, 'with_replay', function ($score, $faker) {
        $score->replayFile()->disk()->put($score->getKey(), 'this-is-totally-a-legit-replay');
    });
