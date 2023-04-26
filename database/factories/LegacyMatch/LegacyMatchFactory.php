<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories\LegacyMatch;

use App\Models\LegacyMatch\LegacyMatch;
use Carbon\Carbon;
use Database\Factories\Factory;

class LegacyMatchFactory extends Factory
{
    protected $model = LegacyMatch::class;

    public function definition(): array
    {
        return [
            'name' => fn() => $this->faker->sentence(),
            'private' => 0,
            'start_time' => fn() => Carbon::now(),
        ];
    }

    public function private(): static
    {
        return $this->state(['private' => 1]);
    }

    public function tourney(): static
    {
        return $this->state(['keep_forever' => 1]);
    }
}
