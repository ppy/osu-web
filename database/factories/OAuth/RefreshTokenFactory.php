<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\OAuth;

use App\Models\OAuth\Token;
use Database\Factories\Factory;
use Laravel\Passport\RefreshToken;

class RefreshTokenFactory extends Factory
{
    protected $model = RefreshToken::class;

    public function definition(): array
    {
        return [
            'access_token_id' => Token::factory(),
            'expires_at' => fn () => now()->addDay(),
            'id' => str_random(40),
            'revoked' => false,
        ];
    }
}
