<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;

$factory->define(Token::class, function (Faker\Generator $faker) {
    return [
        'id' => str_random(40),
        'user_id' => function () {
            return factory(User::class)->create()->getKey();
        },
        'client_id' => function () {
            return factory(Client::class)->create()->getKey();
        },
        'scopes' => ['public'],
        'revoked' => false,
        'expires_at' => function () {
            return now()->addDay();
        },
    ];
});
