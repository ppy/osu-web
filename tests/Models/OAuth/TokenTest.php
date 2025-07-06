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
    private static bool $delegationTestRun = false;
    private static Set $scopesTestedWithDelegation;
    private static Set $scopesTestedWithoutDelegation;

    public static function dataProviderForTestAuthCodeChatWriteRequiresBotGroup()
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

    public static function dataProviderForTestDelegationRequiredScopes()
    {
        $scopes = Passport::scopes()->pluck('id');

        $filterScopes = new Set(Token::SCOPES_REQUIRE_DELEGATION);
        $filterScopes->remove('delegate');
        $delegationScopes = $scopes->intersect($filterScopes);
        $noDelegationScopes = $scopes->filter(fn ($id) => !in_array($id, Token::SCOPES_REQUIRE_DELEGATION, true));

        $data = [
            'delgate scope alone' => [['delegate'], null],
        ];

        foreach ($delegationScopes as $scope) {
            $data["{$scope} requires delegation"] = [[$scope], InvalidScopeException::class];
            $data["{$scope} delegation"] = [[$scope, 'delegate'], null];
        }

        foreach ($noDelegationScopes as $scope) {
            $data["{$scope} does not require delegation"] = [[$scope], null];
            $data["{$scope} fails with delegation"] = [[$scope, 'delegate'], InvalidScopeException::class];
        }

        return $data;
    }

    public static function dataProviderForTestDelegationRequiresChatBot()
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

    public static function dataProviderForTestScopes()
    {
        return [
            'null is not a valid scope' => [null, InvalidScopeException::class],
            'empty scope should fail' => [[], InvalidScopeException::class],
            'all scope is allowed' => [['*'], null],
        ];
    }

    public static function dataProviderForTestScopesClientCredentials()
    {
        return [
            'null is not a valid scope' => [null, InvalidScopeException::class],
            'empty scope should fail' => [[], InvalidScopeException::class],
            'all scope is not allowed' => [['*'], InvalidScopeException::class],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$scopesTestedWithDelegation = new Set();
        self::$scopesTestedWithoutDelegation = new Set();
    }

    public static function tearDownAfterClass(): void
    {
        // Assert all scopes were tested for delegation/no delegation.
        if (!self::$delegationTestRun) {
            return;
        }

        $allScopes = new Set(Passport::scopeIds());

        $missingWithDelegationScopes = $allScopes->diff(self::$scopesTestedWithDelegation);
        if (!$missingWithDelegationScopes->isEmpty()) {
            throw new \Exception('not all scopes tested for delegation: '.json_encode($missingWithDelegationScopes));
        }

        $allScopes->remove('delegate');
        $missingWithoutDelegationScopes = $allScopes->diff(self::$scopesTestedWithoutDelegation);
        if (!$missingWithoutDelegationScopes->isEmpty()) {
            throw new \Exception('not all scopes tested for no delegation: '.json_encode($missingWithoutDelegationScopes));
        }

        parent::tearDownAfterClass();
    }

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
     * @dataProvider dataProviderForTestAuthCodeChatWriteRequiresBotGroup
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
     * @dataProvider dataProviderForTestDelegationRequiredScopes
     */
    public function testDelegationRequiredScopes(array $scopes, ?string $expectedException)
    {
        $this->scopesTested($scopes);

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
     * @dataProvider dataProviderForTestDelegationRequiresChatBot
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
     * @dataProvider dataProviderForTestScopes
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
     * @dataProvider dataProviderForTestScopesClientCredentials
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

    private function scopesTested(array $scopes)
    {
        self::$delegationTestRun = true;

        $scopeSet = new Set($scopes);
        if ($scopeSet->count() > 1) {
            $scopeSet->remove('delegate');
            if ($scopeSet->count() > 1) {
                throw new \Exception('Test 1 scope at a time.');
            }
            self::$scopesTestedWithDelegation->add(...$scopeSet);
        } else {
            if ($scopeSet->contains('delegate')) {
                // this is the test with just 'delegate'.
                self::$scopesTestedWithDelegation->add(...$scopeSet);
            } else {
                self::$scopesTestedWithoutDelegation->add(...$scopeSet);
            }
        }
    }
}
