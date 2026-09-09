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
            'grant_types' => ['authorization_code', 'client_credentials', 'refresh_token'],
            'name' => fn () => $this->faker->realText(20),
            'redirect' => 'https://localhost/callback',
            'revoked' => false,
            'secret' => str_random(40),
            'user_id' => User::factory(),

            'password_client' => false,
            'personal_access_client' => false,
        ];
    }
}
