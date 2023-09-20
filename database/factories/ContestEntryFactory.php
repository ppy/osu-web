<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ContestEntry;
use App\Models\User;

class ContestEntryFactory extends Factory
{
    protected $model = ContestEntry::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'entry_url' => '/images/headers/generic.jpg',
            'name' => fn() => $this->faker->words(3, true),
            'masked_name' => fn() => $this->faker->words(3, true),
        ];
    }
}
