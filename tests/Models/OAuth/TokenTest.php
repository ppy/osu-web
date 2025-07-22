<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Database\Factories\OAuth\RefreshTokenFactory;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TokenTest extends TestCase
{
    public static function dataProviderForTestAuthCodeChatScopesAllowsSelf()
    {
        return static::chatScopes()->map(fn ($scope) => [$scope]);
    }

    public static function dataProviderForTestAuthCodeChatScopesRequiresBotGroup()
    {
        $data = [];
        foreach (static::chatScopes() as $scope) {
            $data[] = [$scope, null, true];
            $data[] = [$scope, 'admin', true];
            $data[] = [$scope, 'bng', true];
            $data[] = [$scope, 'bot', false];
            $data[] = [$scope, 'gmt', true];
            $data[] = [$scope, 'nat', true];
        }

        return $data;
    }

    public static function dataProviderForTestDelegationNotAllowedScopes()
    {
        return array_reject_null(static::allPassportScopeIds()->map(fn ($scope) => match (true) {
            $scope === 'delegate' => null,
            !in_array($scope, Token::SCOPES_REQUIRE_DELEGATION, true) => [[$scope], null],
            default => [[$scope], 'delegate_required'],
        }));
    }

    public static function dataProviderForTestDelegationRequiredScopes()
    {
        return static::allPassportScopeIds()->map(fn ($scope) => match (true) {
            $scope === 'delegate' => [['delegate'], null],
            in_array($scope, Token::SCOPES_REQUIRE_DELEGATION, true) => [[$scope, 'delegate'], null],
            default => [[$scope, 'delegate'], 'delegate_invalid_combination'],
        });
    }

    public static function dataProviderForTestDelegationRequiresChatBot()
    {
        return [
            [null, true],
            ['admin', true],
            ['bng', true],
            ['bot', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    public static function dataProviderForTestScopes()
    {
        return [
            'null is not a valid scope' => [null, 'empty'],
            'empty scope should fail' => [[], 'empty'],
            'all scope is allowed' => [['*'], null],
        ];
    }

    public static function dataProviderForTestScopesClientCredentials()
    {
        return [
            'null is not a valid scope' => [null,'empty'],
            'empty scope should fail' => [[],'empty'],
            'all scope is not allowed' => [['*'], 'all_scope_no_client_credentials'],
        ];
    }

    #[DataProvider('dataProviderForTestAuthCodeChatScopesAllowsSelf')]
    public function testAuthCodeChatScopesAllowsSelf(string $scope)
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $token = $this->createToken($user, [$scope], $client);
        $this->actAsUserWithToken($token);

        $this->assertTrue($user->is($token->getResourceOwner()));
        $this->assertTrue($user->is(auth()->user()));
    }

    #[DataProvider('dataProviderForTestAuthCodeChatScopesRequiresBotGroup')]
    public function testAuthCodeChatScopesRequiresBotGroup(string $scope, ?string $group, bool $shouldThrow)
    {
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $tokenUser = User::factory()->create();

        $this->expectInvalidScopeException($shouldThrow ? 'bot_only' : null);

        $this->createToken($tokenUser, [$scope], $client);
    }

    // Explicitly test chat.read because it's the odd one out.
    public function testChatReadCannotBeDelegated()
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException('client_credentials_only');
        $this->createToken($user, ['chat.read', 'delegate'], $client);
    }

    public function testClientCredentialsRequiredForDelegation()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException('client_credentials_only');
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

    #[DataProvider('dataProviderForTestDelegationNotAllowedScopes')]
    public function testDelegationNotAllowedScopes(array $scopes, ?string $exceptionKey)
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException($exceptionKey);

        $this->createToken(null, $scopes, $client);
    }

    #[DataProvider('dataProviderForTestDelegationRequiredScopes')]
    public function testDelegationRequiredScopes(array $scopes, ?string $exceptionKey)
    {
        $user = User::factory()->withGroup('bot')->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException($exceptionKey);

        $this->createToken(null, $scopes, $client);
    }

    #[DataProvider('dataProviderForTestDelegationRequiresChatBot')]
    public function testDelegationRequiresChatBot(?string $group, bool $shouldThrow)
    {
        $user = User::factory()->withGroup($group)->create();
        $client = Client::factory()->create(['user_id' => $user]);
        $tokenUser = User::factory()->create();

        $this->expectInvalidScopeException($shouldThrow ? 'delegate_bot_only' : null);

        $this->createToken(null, ['delegate'], $client);
    }

    #[DataProvider('dataProviderForTestScopes')]
    public function testScopes($scopes, ?string $exceptionKey)
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException($exceptionKey);

        $this->createToken($user, $scopes, $client);
    }

    public function testScopesAreSorted()
    {
        $token = new Token();
        $token->scopes = ['i', 'am', 'a', 'scope'];

        $this->assertSame(['a', 'am', 'i', 'scope'], $token->scopes);
    }

    #[DataProvider('dataProviderForTestScopesClientCredentials')]
    public function testScopesClientCredentials($scopes, $exceptionKey)
    {
        $user = User::factory()->create();
        $client = Client::factory()->create(['user_id' => $user]);

        $this->expectInvalidScopeException($exceptionKey);

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
}
