<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\Language;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        return [
            // 'name' is varchar(50) and some generated strings are longer than that
            'name' => fn () => substr($this->faker->country(), 0, 50),
        ];
    }
}
