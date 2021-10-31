<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\NewsPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsPostFactory extends Factory
{
    protected $model = NewsPost::class;

    public function definition(): array
    {
        return [
            'created_at' => fn () => $this->faker->dateTime(),
            'slug' => fn () => $this->faker->date().'-'.$this->faker->slug(),

            // depends on created_at
            'updated_at' => fn (array $attr) => $attr['created_at'],
        ];
    }
}
