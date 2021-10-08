<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAccountHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAccountHistoryFactory extends Factory
{
    protected $model = UserAccountHistory::class;

    public function definition()
    {
        return [
            'reason' => fn () => $this->faker->bs(),
            // 5 minutes (300 seconds) times 2 to the nth power (as in the standard osu silence durations)
            'period' => fn () => 300 * (2 ** rand(1, 10)),
            'banner_id' => fn () => User::inRandomOrder()->first(),
        ];
    }

    public function note()
    {
        return $this->state(['ban_status' => 0]);
    }

    public function restriction()
    {
        return $this->state(['ban_status' => 1]);
    }

    public function silence()
    {
        return $this->state(['ban_status' => 2]);
    }
}
