<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserRelation;

class UserRelationFactory extends Factory
{
    protected $model = UserRelation::class;

    public function block(): static
    {
        return $this->state(['foe' => true]);
    }

    public function definition(): array
    {
        return [];
    }

    public function friend(): static
    {
        return $this->state(['friend' => true]);
    }
}
