<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\AuthOption;
use App\Models\Forum\Authorize;
use Database\Factories\Factory;

class AuthorizeFactory extends Factory
{
    protected $model = Authorize::class;

    public function definition(): array
    {
        return ['auth_setting' => 1];
    }

    public function post(): static
    {
        return $this->authOption('post');
    }

    public function reply(): static
    {
        return $this->authOption('reply');
    }

    private function authOption(string $option): static
    {
        return $this->state(['auth_option_id' => function () use ($option) {
            return AuthOption::where('auth_option', "f_{$option}")->first()
                ?? AuthOption::factory()->$option();
        }]);
    }
}
