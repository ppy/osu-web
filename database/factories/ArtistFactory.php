<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Artist;

class ArtistFactory extends Factory
{
    protected $model = Artist::class;

    public function definition(): array
    {
        return [
            'name' => fn() => "{$this->faker->lastName()} {$this->faker->colorName()}",
            'description' => fn() => $this->faker->realText(),
            'website' => fn() => $this->faker->safeEmailDomain(),
            'cover_url' => '/images/headers/generic.jpg',
            'header_url' => '/images/headers/generic.jpg',
            'visible' => 1,
        ];
    }
}
