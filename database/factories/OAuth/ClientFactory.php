<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\OAuth;

use App\Models\OAuth\Client;
use App\Models\User;
use Database\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fn () => $this->faker->realText(20),
            'secret' => str_random(40),
            'redirect' => 'https://localhost/callback',
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ];
    }
}
