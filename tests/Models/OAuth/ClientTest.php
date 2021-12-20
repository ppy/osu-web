<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\OAuth;

use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Laravel\Passport\AuthCode;
use Laravel\Passport\RefreshToken;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var User */
    protected $owner;

    public function testScopesFromTokensAreAggregated()
    {
        $user = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $this->client->tokens()->create([
            'id' => '2',
            'revoked' => false,
            'scopes' => ['friends.read'],
            'user_id' => $user->getKey(),
        ]);

        $clients = Client::forUser($user);
        $this->assertCount(1, $clients);
        $this->assertSame(['friends.read', 'identify'], $clients[0]->scopes);
    }

    public function testScopesFromDifferentClientsAreNotAggregated()
    {
        $user = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $otherClient = Client::factory()->create(['user_id' => $this->owner]);
        $otherClient->tokens()->create([
            'id' => '2',
            'revoked' => false,
            'scopes' => ['friends.read'],
            'user_id' => $user->getKey(),
        ]);

        $clients = Client::forUser($user);
        $this->assertSame(['identify'], $clients->find($this->client->getKey())->scopes);
        $this->assertSame(['friends.read'], $clients->find($otherClient->getKey())->scopes);
    }

    public function testScopesFromRevokedTokensAreNotAggregated()
    {
        $user = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $this->client->tokens()->create([
            'id' => '2',
            'revoked' => true,
            'scopes' => ['friends.read'],
            'user_id' => $user->getKey(),
        ]);

        $clients = Client::forUser($user);
        $this->assertCount(1, $clients);
        $this->assertSame(['identify'], $clients[0]->scopes);
    }

    public function testClientWithOnlyRevokedTokensDoesNotShow()
    {
        $user = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => true,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $clients = Client::forUser($user);
        $this->assertEmpty($clients);
    }

    public function testRevokingClientRemovesItFromTheList()
    {
        $user = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $this->assertCount(1, Client::forUser($user));
        $this->client->revokeForUser($user);
        $this->assertCount(0, Client::forUser($user));
    }

    public function testDoesNotAggregateScopesFromOtherUsers()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user1->getKey(),
        ]);

        $this->client->tokens()->create([
            'id' => '2',
            'revoked' => false,
            'scopes' => ['friends.read'],
            'user_id' => $user2->getKey(),
        ]);

        $clients = Client::forUser($user1);
        $this->assertCount(1, $clients);
        $this->assertSame(['identify'], $clients[0]->scopes);
    }

    public function testDoesNotRevokeOtherUserTokens()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user1->getKey(),
        ]);

        $this->client->tokens()->create([
            'id' => '2',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user2->getKey(),
        ]);

        $this->assertCount(1, Client::forUser($user1));
        $this->assertCount(1, Client::forUser($user2));
        $this->client->revokeForUser($user1);
        $this->assertCount(0, Client::forUser($user1));
        $this->assertCount(1, Client::forUser($user2));
    }

    public function testNumberOfClientsIsLimited()
    {
        config()->set('osu.oauth.max_user_clients', 1);

        $client = Client::factory()->create(['user_id' => $this->owner]);
        $this->assertFalse($client->exists);
        $this->assertArrayHasKey('user.oauthClients.count', $client->validationErrors()->all());
    }

    public function testNumberOfClientsLimitDoesNotIncludeRevokedClients()
    {
        config()->set('osu.oauth.max_user_clients', 1);
        $this->client->update(['revoked' => true]);

        $client = Client::factory()->create(['user_id' => $this->owner]);
        $this->assertTrue($client->exists);
        $this->assertEmpty($client->validationErrors()->all());
    }

    public function testRevokingClientSkipsValidation()
    {
        $client = Client::factory()->make(['user_id' => $this->owner]);
        $client->save(['skipValidations' => true]);
        $this->assertTrue($client->exists);
        $client->revoke();
        $this->assertTrue($client->fresh()->revoked);
    }

    public function testResetSecretChangesClientSecret()
    {
        $oldSecret = $this->client->secret;

        $this->client->resetSecret();

        $this->assertNotSame($oldSecret, $this->client->secret);
    }

    public function testResetSecretInvalidatesExistingTokens()
    {
        $user = User::factory()->create();
        $token = $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $token->refreshToken()->create([
            'id' => '1',
            'revoked' => false,
        ]);

        $this->client->authCodes()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => json_encode(['identify']),
            'user_id' => $user->getKey(),
        ]);

        // assert no revoked tokens;
        $this->assertSame(1, Token::where('revoked', false)->count());
        $this->assertSame(1, RefreshToken::where('revoked', false)->count());
        $this->assertSame(1, AuthCode::where('revoked', false)->count());

        $this->client->resetSecret();

        // assert no unrevoked tokens;
        $this->assertSame(0, Token::where('revoked', false)->count());
        $this->assertSame(0, RefreshToken::where('revoked', false)->count());
        $this->assertSame(0, AuthCode::where('revoked', false)->count());
    }

    public function testResetSecretPreventsAccessWithExistingToken()
    {
        $user = User::factory()->create();
        $token = $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $this->client->resetSecret();
        $token->refresh();
        $this->actAsUserWithToken($token);

        $this->get(route('api.me'))->assertUnauthorized();
    }

    public function testPassportCreateClientCommand()
    {
        $countBefore = Client::count();

        $this->artisan('passport:client', ['--password' => true])
            ->expectsQuestion('What should we name the password grant client?', 'potato')
            ->expectsQuestion('Which user provider should this client use to retrieve users?', 'user');

        $this->assertSame($countBefore + 1, Client::count(), 'client was not created.');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->owner]);
    }
}
