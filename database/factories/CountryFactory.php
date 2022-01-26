<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'acronym' => fn () => $this->faker->unique()->countryCode(),
            'name' => fn () => $this->faker->unique()->country(),
            'playcount' => rand(10000000, 200000000),
            'pp' => rand(1000000, 45000000),
            'rankedscore' => rand(5000000, 500000000) * 10000,
            'usercount' => rand(10000, 600000),
        ];
    }

    public function fallback(): static
    {
        return $this->state([
            'acronym' => Country::UNKNOWN,
            'name' => '',
        ]);
    }
}
