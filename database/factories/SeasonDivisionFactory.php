<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Season;
use App\Models\SeasonDivision;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonDivisionFactory extends Factory
{
    protected $model = SeasonDivision::class;

    public function definition(): array
    {
        return [
            'colour_tier' => 'gold',
            'image_url' => '/images/layout/season-division.png',
            'name' => $this->faker->word(),
            'season_id' => Season::factory(),
            'threshold' => 1.0,
        ];
    }
}
