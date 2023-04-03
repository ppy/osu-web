<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contest;
use Carbon\Carbon;

class ContestFactory extends Factory
{
    protected $model = Contest::class;

    public function completed(): static
    {
        return $this->state([
            'entry_starts_at' => fn() => Carbon::now()->subMonths(4),
            'entry_ends_at' => fn() => Carbon::now()->subMonths(3),
            'voting_starts_at' => fn() => Carbon::now()->subMonths(2),
            'voting_ends_at' => fn() => Carbon::now()->subMonths(1),
        ]);
    }

    public function definition(): array
    {
        return [
            'name' => fn() => $this->faker->sentence(),
            'description_enter' => fn() => $this->faker->paragraph(),
            'description_voting' => fn() => $this->faker->paragraph(),
            'type' => 'art',
            'header_url' => '/images/headers/generic.jpg',
            'visible' => 1,
        ];
    }

    public function entry(): static
    {
        return $this->state([
            'entry_starts_at' => fn() => Carbon::now()->subMonths(1),
            'entry_ends_at' => fn() => Carbon::now()->addMonths(1),
            'voting_starts_at' => fn() => Carbon::now()->addMonths(2),
            'voting_ends_at' => fn() => Carbon::now()->addMonths(3),
        ]);
    }

    public function pending(): static
    {
        return $this->state([
            'entry_starts_at' => fn() => Carbon::now()->addMonths(1),
            'entry_ends_at' => fn() => Carbon::now()->addMonths(2),
            'voting_starts_at' => fn() => Carbon::now()->addMonths(3),
            'voting_ends_at' => fn() => Carbon::now()->addMonths(4),
        ]);
    }

    public function voting(): static
    {
        return $this->state([
            'entry_starts_at' => fn() => Carbon::now()->subMonths(3),
            'entry_ends_at' => fn() => Carbon::now()->subMonths(2),
            'voting_starts_at' => fn() => Carbon::now()->subMonths(1),
            'voting_ends_at' => fn() => Carbon::now()->addMonths(1),
        ]);
    }
}
