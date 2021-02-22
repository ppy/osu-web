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
        $user = factory(User::class)->create();
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
        $user = factory(User::class)->create();
        $this->client->tokens()->create([
            'id' => '1',
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ]);

        $otherClient = factory(Client::class)->create(['user_id' => $this->owner->getKey()]);
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
        $user = factory(User::class)->create();
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
        $user = factory(User::class)->create();
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
        $user = factory(User::class)->create();
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
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
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
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
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

        $client = factory(Client::class)->create(['user_id' => $this->owner->getKey()]);
        $this->assertFalse($client->exists);
        $this->assertArrayHasKey('user.oauthClients.count', $client->validationErrors()->all());
    }

    public function testNumberOfClientsLimitDoesNotIncludeRevokedClients()
    {
        config()->set('osu.oauth.max_user_clients', 1);
        $this->client->update(['revoked' => true]);

        $client = factory(Client::class)->create(['user_id' => $this->owner->getKey()]);
        $this->assertTrue($client->exists);
        $this->assertEmpty($client->validationErrors()->all());
    }

    public function testRevokingClientSkipsValidation()
    {
        $client = factory(Client::class)->make(['user_id' => $this->owner->getKey()]);
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
        $user = factory(User::class)->create();
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
        $user = factory(User::class)->create();
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

        $this->owner = factory(User::class)->create();
        $this->client = factory(Client::class)->create(['user_id' => $this->owner->getKey()]);
    }
}
