<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Group;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'group_name' => fn() => "{$this->faker->colorName()} {$this->faker->domainWord()}",
            'group_desc' => fn() => $this->faker->sentence(),
        ];
    }
}
