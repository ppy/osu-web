<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\AuthOption;
use Database\Factories\Factory;

class AuthOptionFactory extends Factory
{
    protected $model = AuthOption::class;

    public function definition(): array
    {
        return [];
    }

    public function post(): static
    {
        return $this->state(['auth_option' => 'f_post']);
    }

    public function postCount(): static
    {
        return $this->state(['auth_option' => 'f_postcount']);
    }

    public function reply(): static
    {
        return $this->state(['auth_option' => 'f_reply']);
    }
}
