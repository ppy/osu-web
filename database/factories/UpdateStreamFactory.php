<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UpdateStream;

class UpdateStreamFactory extends Factory
{
    protected $model = UpdateStream::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->colorName(),

            'pretty_name' => fn (array $attr) => $attr['name'],
        ];
    }
}
