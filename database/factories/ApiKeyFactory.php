<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApiKey;
use App\Models\User;

class ApiKeyFactory extends Factory
{
    protected $model = ApiKey::class;

    public function definition(): array
    {
        return [
            'api_key' => bin2hex(random_bytes(20)),
            'app_name' => fn () => $this->faker->word(),
            'app_url' => fn () => "https://{$this->faker->word()}",
            'user_id' => User::factory(),
        ];
    }
}
