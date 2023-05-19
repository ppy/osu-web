<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\LegacyMatch;

use App\Models\Beatmap;
use App\Models\LegacyMatch\Game;
use Carbon\Carbon;
use Database\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'beatmap_id' => Beatmap::factory(),
            'scoring_type' => fn() => $this->faker->numberBetween(0, 3),
            'team_type' => fn() => $this->faker->numberBetween(0, 3),

            'play_mode' => fn(array $attributes) => Beatmap::find($attributes['beatmap_id'])->playmode,
            'start_time' => fn(array $attributes) => Carbon::now()->subSeconds(Beatmap::find($attributes['beatmap_id'])->total_length),
        ];
    }

    public function inProgress(): static
    {
        return $this->state(['end_time' => null]);
    }

    public function complete(): static
    {
        return $this->state(['end_time' => fn() => Carbon::now()]);
    }
}
