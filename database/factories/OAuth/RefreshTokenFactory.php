<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\OAuth\Token;
use Laravel\Passport\RefreshToken;

$factory->define(RefreshToken::class, function (Faker\Generator $faker) {
    return [
        'id' => str_random(40),
        'access_token_id' => function () {
            return factory(Token::class)->create()->getKey();
        },
        'revoked' => false,
        'expires_at' => function () {
            return now()->addDay();
        },
    ];
});
