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
        $this->assertTrue($token->validate());
    }

    /**
     * @dataProvider botScopeRequiresBotGroupDataProvider
     */
    public function testBotScopeRequiresBotGroup($group, $expectedException)
    {
        $user = factory(User::class);
        if ($group !== null) {
            $user->states($group);
        }
        $user = $user->create();

        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['bot'],
            'user_id' => null,
        ]);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $this->assertTrue($token->validate());
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

    public function testClientCredentialResourceOwnerPublic()
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

    /**
     * @dataProvider scopesDataProvider
     *
     * @return void
     */
    public function testScopes($scopes, $expectedException)
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => $scopes,
            'user_id' => factory(User::class)->create()->getKey(),
        ]);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $this->assertTrue($token->validate());
    }

    /**
     * @dataProvider scopesClientCredentialsDataProvider
     *
     * @return void
     */
    public function testScopesClientCredentials($scopes, $expectedException)
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $client->tokens()->create([
            'expires_at' => now()->addDays(1),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => $scopes,
            'user_id' => null,
        ]);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $this->assertTrue($token->validate());
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

    public function scopesDataProvider()
    {
        return [
            'null is not a valid scope' => [null, MissingScopeException::class],
            'empty scope should fail' => [[], MissingScopeException::class],
            'all scope is allowed' => [['*'], null],
        ];
    }

    public function scopesClientCredentialsDataProvider()
    {
        return [
            'null is not a valid scope' => [null, MissingScopeException::class],
            'empty scope should fail' => [[], MissingScopeException::class],
            'all scope is not allowed' => [['*'], MissingScopeException::class],
        ];
    }

    public function botScopeRequiresBotGroupDataProvider()
    {
        return [
            [null, MissingScopeException::class],
            ['admin', MissingScopeException::class],
            ['bng', MissingScopeException::class],
            ['bot', null],
            ['gmt', MissingScopeException::class],
            ['nat', MissingScopeException::class],
        ];
    }
}
