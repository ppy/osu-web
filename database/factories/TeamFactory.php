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

    public function configure(): static
    {
        return $this->afterCreating(function (Team $team): void {
            $team->members()->create(['user_id' => $team->leader_id]);
        });
    }

    public function definition(): array
    {
        return [
            'name' => fn () => $this->faker->name(),
            'short_name' => fn () => $this->faker->domainWord(),
            'leader_id' => User::factory(),
        ];
    }
}
