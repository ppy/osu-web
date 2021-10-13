<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\OAuth\Client::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return App\Models\User::factory()->create(['user_sig' => ''])->getKey();
        },
        'name' => function () use ($faker) {
            return $faker->realText(20);
        },
        'secret' => str_random(40),
        'redirect' => 'https://localhost/callback',
        'personal_access_client' => false,
        'password_client' => false,
        'revoked' => false,
    ];
});
