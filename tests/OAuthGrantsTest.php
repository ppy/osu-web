<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Models\OAuth\Client;
use App\Models\User;

class OAuthGrantsTest extends TestCase
{
    public function testClientCredentialResourceOwner()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['public'],
            'user_id' => null,
        ]);

        $this->actAsUserWithToken($token);

        $this->assertTrue($token->isClientCredentials());
        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }
}
