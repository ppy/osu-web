<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeatmapPack;

class BeatmapPackFactory extends Factory
{
    protected $model = BeatmapPack::class;

    public function definition(): array
    {
        return [
            'author' => fn () => $this->faker->username(),
            'date' => fn () => now()->subMonths(2),
            'name' => fn () => $this->faker->catchPhrase(),
            'tag' => fn () => $this->faker->randomElement(['S', 'T', 'A', 'R']).$this->faker->numberBetween(10, 100),
            'url' => fn () => $this->faker->url(),
        ];
    }
}
