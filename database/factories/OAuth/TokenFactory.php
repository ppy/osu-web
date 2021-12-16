<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\OAuth;

use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
{
    protected $model = Token::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'expires_at' => fn () => now()->addDay(),
            'id' => str_random(40),
            'revoked' => false,
            'scopes' => ['public'],
            'user_id' => User::factory(),
        ];
    }
}
