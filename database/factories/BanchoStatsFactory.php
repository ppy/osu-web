<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BanchoStats;
use Carbon\Carbon;

class BanchoStatsFactory extends Factory
{
    protected $model = BanchoStats::class;

    public function definition(): array
    {
        return [
            'users_irc' => fn() => 100 + $this->faker->randomNumber(2),
            'users_osu' => fn() => 10000 + $this->faker->randomNumber(4),
            'multiplayer_games' => fn() => 200 + $this->faker->randomNumber(3),
            'date' => fn() => Carbon::now(),
        ];
    }
}
