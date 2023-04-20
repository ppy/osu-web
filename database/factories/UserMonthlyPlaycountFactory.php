<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserMonthlyPlaycount;

class UserMonthlyPlaycountFactory extends Factory
{
    protected $model = UserMonthlyPlaycount::class;

    public function definition(): array
    {
        return [
            'playcount' => fn () => $this->faker->numberBetween(500, 2000),
            'year_month' => fn () => $this->faker->dateTimeBetween('-6 years')->format('ym'),
        ];
    }
}
