<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contest;
use App\Models\ContestScoringCategory;

class ContestScoringCategoryFactory extends Factory
{
    protected $model = ContestScoringCategory::class;

    public function definition(): array
    {
        return [
            'contest_id' => Contest::factory(),
            'description' => $this->faker->sentence(),
            'max_value' => 10,
            'name' => $this->faker->unique()->word(),
        ];
    }
}
