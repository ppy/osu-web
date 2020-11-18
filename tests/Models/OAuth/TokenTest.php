<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Models\OAuth\Client;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\RefreshToken;
use Tests\TestCase;

class TokenTest extends TestCase
{
    public function testBotTokenSingleScope()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['bot', 'public'],
            'user_id' => null,
        ]);

        $this->expectException(MissingScopeException::class);
        $token->validate();
    }

    public function testClientCredentialResourceOwnerBot()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['bot'],
            'user_id' => null,
        ]);

        $this->actAsUserWithToken($token);

        $this->assertTrue($token->isClientCredentials());
        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }

    public function testClientCredentialResourcePublic()
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
        $this->assertNull($token->getResourceOwner());
        $this->assertNull(auth()->user());
    }

    public function testRevokeRecursive()
    {
        Event::fake();

        $refreshToken = factory(RefreshToken::class)->create();
        $token = $refreshToken->accessToken;

        $this->assertFalse($refreshToken->revoked);
        $this->assertFalse($token->revoked);

        $token->revokeRecursive();

        $this->assertTrue($refreshToken->fresh()->revoked);
        $this->assertTrue($token->fresh()->revoked);
        Event::assertDispatched(UserSessionEvent::class);
    }
}
