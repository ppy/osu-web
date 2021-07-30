<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Models\OAuth\Client;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\RefreshToken;
use Tests\TestCase;

class TokenTest extends TestCase
{
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

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken(null, ['bot'], $client);
    }

    public function testClientCredentialsAllowsDelegation()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        $this->expectNotToPerformAssertions();
        $this->createToken(null, ['bot'], $client);
    }

    public function testClientCredentialResourceOwnerBot()
    {
        $user = factory(User::class)->states('bot')->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $this->createToken(null, ['bot'], $client);

        $this->actAsUserWithToken($token);

        $this->assertTrue($token->isClientCredentials());
        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }

    public function testClientCredentialResourceOwnerPublic()
    {
        $user = factory(User::class)->states('bot')->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $this->createToken(null, ['public'], $client);

        $this->actAsUserWithToken($token);

        $this->assertTrue($token->isClientCredentials());
        $this->assertNull($token->getResourceOwner());
        $this->assertNull(auth()->user());
    }

    public function testDelegationRequiresClientCredentials()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        $this->expectException(InvalidScopeException::class);
        $this->createToken($user, ['bot'], $client);
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

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken($user, $scopes, $client);
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

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken(null, $scopes, $client);
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
            'null is not a valid scope' => [null, InvalidScopeException::class],
            'empty scope should fail' => [[], InvalidScopeException::class],
            'all scope is allowed' => [['*'], null],
        ];
    }

    public function scopesClientCredentialsDataProvider()
    {
        return [
            'null is not a valid scope' => [null, InvalidScopeException::class],
            'empty scope should fail' => [[], InvalidScopeException::class],
            'all scope is not allowed' => [['*'], InvalidScopeException::class],
        ];
    }

    public function botScopeRequiresBotGroupDataProvider()
    {
        return [
            [null, InvalidScopeException::class],
            ['admin', InvalidScopeException::class],
            ['bng', InvalidScopeException::class],
            ['bot', null],
            ['gmt', InvalidScopeException::class],
            ['nat', InvalidScopeException::class],
        ];
    }
}
