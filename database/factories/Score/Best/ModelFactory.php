<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Score\Best;

use App\Models\Beatmap;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

abstract class ModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'beatmap_id' => fn () => Beatmap::factory()->state([
                // force playmode to match score type
                'playmode' => Beatmap::modeInt($this->model::getMode()),
            ]),
            'date' => fn () => $this->faker->dateTimeBetween('-5 years'),
            'enabled_mods' => array_rand_val([0, 16, 24, 64, 72]),
            'score' => rand(50000, 100000000),
            'user_id' => fn () => User::factory(),
            'rank' => array_rand_val(['A', 'S', 'B', 'SH', 'XH', 'X']),

            // depends on beatmap_id
            'maxcombo' => fn (array $attr) => rand(1, Beatmap::find($attr['beatmap_id'])->countNormal),
            'pp' => function (array $attr) {
                $diff = Beatmap::find($attr['beatmap_id'])->difficultyrating;

                return $this->faker->biasedNumberBetween(10, 100) * 1.5 * $diff;
            },

            // depends on maxcombo
            'count100' => fn (array $attr) => rand(0, (int) round($attr['maxcombo'] * 0.15)),
            'count300' => fn (array $attr) => round($attr['maxcombo'] * 0.8),
            'count50' => fn (array $attr) => rand(0, (int) round($attr['maxcombo'] * 0.05)),
            'countgeki' => fn (array $attr) => round($attr['maxcombo'] * 0.3),
            'countkatu' => fn (array $attr) => round($attr['maxcombo'] * 0.05),
            'countmiss' => fn (array $attr) => round($attr['maxcombo'] * 0.05),
        ];
    }

    public function withReplay()
    {
        return $this->state([
            'replay' => true,
        ])->afterCreating(function ($score) {
            $score->replayFile()->disk()->put($score->getKey(), 'this-is-totally-a-legit-replay');
        });
    }
}
