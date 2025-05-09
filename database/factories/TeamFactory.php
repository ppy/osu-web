<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => fn () => strtr($this->faker->unique()->userName(), '.', ' '),
            'short_name' => fn () => substr(strtr($this->faker->unique()->userName(), '.', ' '), 0, 4),
            'leader_id' => User::factory(),
        ];
    }
}
