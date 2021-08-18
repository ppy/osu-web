<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;
use Tests\TestCase;

class TokenTest extends TestCase
{
    public function testAuthCodeChatWriteAllowsSelf()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        $token = $this->createToken($user, ['chat.write'], $client);
        $this->actAsUserWithToken($token);

        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }

    /**
     * @dataProvider authCodeChatWriteRequiresBotGroupDataProvider
     */
    public function testAuthCodeChatWriteRequiresBotGroup(?string $group, ?string $expectedException)
    {
        $user = factory(User::class)->states($group ?? [])->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $tokenUser = factory(User::class)->create();

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken($tokenUser, ['chat.write'], $client);
    }

    public function testClientCredentialsRequiredForDelegation()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        $this->expectException(InvalidScopeException::class);
        $this->createToken($user, ['delegate'], $client);
    }

    public function testClientCredentialResourceOwnerBot()
    {
        $user = factory(User::class)->states('bot')->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $token = $this->createToken(null, ['delegate'], $client);

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

    /**
     * @dataProvider delegationNotAllowedScopesDataProvider
     */
    public function testDelegationNotAllowedScopes(array $scopes)
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        $this->expectException(InvalidScopeException::class);
        $this->createToken(null, $scopes, $client);
    }

    /**
     * @dataProvider delegationRequiredScopesDataProvider
     */
    public function testDelegationRequiredScopes(array $scopes, ?string $expectedException)
    {
        $user = factory(User::class)->states('bot')->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken(null, $scopes, $client);
    }

    /**
     * @dataProvider delegationRequiresChatBotDataProvider
     */
    public function testDelegationRequiresChatBot(?string $group, ?string $expectedException)
    {
        $user = factory(User::class)->states($group ?? [])->create();
        $client = factory(Client::class)->create(['user_id' => $user->getKey()]);
        $tokenUser = factory(User::class)->create();

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken(null, ['delegate'], $client);
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

    public function testScopesAreSorted()
    {
        $token = new Token();
        $token->scopes = ['i', 'am', 'a', 'scope'];

        $this->assertSame(['a', 'am', 'i', 'scope'], $token->scopes);
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

    public function authCodeChatWriteRequiresBotGroupDataProvider()
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

    public function delegationNotAllowedScopesDataProvider()
    {
        return Passport::scopes()
            ->pluck('id')
            ->filter(fn ($id) => !in_array($id, ['chat.write', 'delegate'], true))
            ->map(fn ($id) => [['delegate', $id]])
            ->values();
    }

    public function delegationRequiredScopesDataProvider()
    {
        return [
            'chat.write requires delegation' => [['chat.write'], InvalidScopeException::class],
            'chat.write delegation' => [['chat.write', 'delegate'], null],
        ];
    }

    public function delegationRequiresChatBotDataProvider()
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
}
