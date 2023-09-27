<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ChatFilter;

class ChatFilterFactory extends Factory
{
    protected $model = ChatFilter::class;

    public function definition(): array
    {
        return [
            'match' => fn() => $this->faker->unique()->word,
            'replacement' => fn() => $this->faker->word,
        ];
    }
}
