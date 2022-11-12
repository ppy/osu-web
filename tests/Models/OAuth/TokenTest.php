<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Database\Factories\OAuth\RefreshTokenFactory;
use Ds\Set;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TokenTest extends TestCase
{
    public function testAuthCodeChatWriteAllowsSelf()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

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
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $tokenUser = User::factory()->create();

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken($tokenUser, ['chat.write'], $client);
    }

    public function testClientCredentialsRequiredForDelegation()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectException(InvalidScopeException::class);
        $this->createToken($user, ['delegate'], $client);
    }

    public function testClientCredentialResourceOwnerBot()
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $token = $this->createToken(null, ['delegate'], $client);

        $this->actAsUserWithToken($token);

        $this->assertTrue($token->isClientCredentials());
        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }

    public function testClientCredentialResourceOwnerPublic()
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);
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
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectException(InvalidScopeException::class);
        $this->createToken(null, $scopes, $client);
    }

    /**
     * @dataProvider delegationRequiredScopesDataProvider
     */
    public function testDelegationRequiredScopes(array $scopes, ?string $expectedException)
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);

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
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $tokenUser = User::factory()->create();

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $this->createToken(null, ['delegate'], $client);
    }

    /**
     * @dataProvider implyScopesDataProvider
     */
    public function testImplyScopes(string $scope, bool $can): void
    {
        $user = User::factory()->create();
        $token = $this->createToken($user, ['*']);

        $this->assertSame($can, $token->can($scope));
    }

    public function testLovedScope(): void
    {
        $client = Client::factory()->create();
        config()->set('osu.loved.oauth_client_id', $client->getKey());

        $this->expectNotToPerformAssertions();

        $this->createToken(null, ['loved'], $client);
    }

    public function testLovedScopeInvalidClient(): void
    {
        $client = Client::factory()->create();
        config()->set('osu.loved.oauth_client_id', $client->getKey() + 1);

        $this->expectException(InvalidScopeException::class);

        $this->createToken(null, ['loved'], $client);
    }

    public function testLovedScopeNoClientConfigured(): void
    {
        config()->set('osu.loved.oauth_client_id', null);

        $this->expectException(InvalidScopeException::class);

        $this->createToken(null, ['loved']);
    }

    /**
     * @dataProvider scopesDataProvider
     *
     * @return void
     */
    public function testScopes($scopes, $expectedException)
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

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
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

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

        $refreshToken = (new RefreshTokenFactory())->create();
        $token = $refreshToken->accessToken;

        $this->assertFalse($refreshToken->revoked);
        $this->assertFalse($token->revoked);

        $token->revokeRecursive();

        $this->assertTrue($refreshToken->fresh()->revoked);
        $this->assertTrue($token->fresh()->revoked);
        Event::assertDispatched(UserSessionEvent::class, fn (UserSessionEvent $event) => $event->action === 'logout');
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

    public function implyScopesDataProvider(): array
    {
        $cannotImply = new Set(['delegate', 'loved']);

        return Passport::scopes()
            ->pluck('id')
            ->map(fn (string $id) => [$id, !$cannotImply->contains($id)])
            ->values()
            ->toArray();
    }

    public function scopesDataProvider()
    {
        return [
            'null is not a valid scope' => [null, InvalidScopeException::class],
            'empty scope should fail' => [[], InvalidScopeException::class],
            'all scope is allowed' => [['*'], null],
            'loved scope is not allowed' => [['loved'], InvalidScopeException::class],
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
