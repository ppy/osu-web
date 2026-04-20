<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\OAuth;

use App\Libraries\OAuth\TokenCache;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Cache;
use Tests\TestCase;

class TokenCacheTest extends TestCase
{
    private Client $client;
    private User $owner;

    public function testPutStoresToken(): void
    {
        $token = $this->makeToken();

        TokenCache::put($token);

        $cached = TokenCache::get($token->getKey());
        $this->assertNotNull($cached);
        $this->assertSame($token->getKey(), $cached->getKey());
    }

    public function testPutIsSkippedWhenDurationIsZero(): void
    {
        config_set('osu.oauth.token_cache_duration', 0);
        $token = $this->makeToken();

        TokenCache::put($token);

        $this->assertNull(TokenCache::get($token->getKey()));
    }

    public function testGetReturnsNullForUnknownToken(): void
    {
        $this->assertNull(TokenCache::get('missing-token-id'));
    }

    public function testForgetRemovesCachedToken(): void
    {
        $token = $this->makeToken();
        TokenCache::put($token);
        $this->assertNotNull(TokenCache::get($token->getKey()));

        TokenCache::forget($token->getKey());

        $this->assertNull(TokenCache::get($token->getKey()));
    }

    public function testTokenRevokeClearsCache(): void
    {
        $token = $this->makeToken();
        TokenCache::put($token);
        $this->assertNotNull(TokenCache::get($token->getKey()));

        $token->revoke();

        $this->assertNull(TokenCache::get($token->getKey()));
    }

    public function testClientRevokeClearsAllItsCachedTokens(): void
    {
        $tokenA = $this->makeToken();
        $tokenB = $this->makeToken();
        TokenCache::put($tokenA);
        TokenCache::put($tokenB);

        $this->client->revoke();

        $this->assertNull(TokenCache::get($tokenA->getKey()));
        $this->assertNull(TokenCache::get($tokenB->getKey()));
    }

    public function testClientRevokeForUserClearsOnlyThatUserTokens(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $tokenForUser1 = $this->makeToken($user1);
        $tokenForUser2 = $this->makeToken($user2);
        TokenCache::put($tokenForUser1);
        TokenCache::put($tokenForUser2);

        $this->client->revokeForUser($user1);

        $this->assertNull(TokenCache::get($tokenForUser1->getKey()));
        $this->assertNotNull(TokenCache::get($tokenForUser2->getKey()));
    }

    public function testClientResetSecretClearsCachedTokens(): void
    {
        $token = $this->makeToken();
        TokenCache::put($token);
        $this->assertNotNull(TokenCache::get($token->getKey()));

        $this->client->resetSecret();

        $this->assertNull(TokenCache::get($token->getKey()));
    }

    public function testMiddlewareCachesValidatedToken(): void
    {
        $user = User::factory()->create();
        $token = $this->client->tokens()->create([
            'expires_at' => now()->addDay(),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['*'],
            'user_id' => $user->getKey(),
            'verified' => true,
        ]);

        $this->actingWithToken($token)->get(route('api.me'))->assertSuccessful();

        $cached = TokenCache::get($token->getKey());
        $this->assertNotNull($cached);
        $this->assertSame((string) $token->getKey(), (string) $cached->getKey());
        $this->assertSame((string) $this->client->getKey(), (string) $cached->client_id);
    }

    public function testMiddlewareRejectsCachedTokenWithMismatchedClientId(): void
    {
        $user = User::factory()->create();
        $realToken = $this->client->tokens()->create([
            'expires_at' => now()->addDay(),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['*'],
            'user_id' => $user->getKey(),
            'verified' => true,
        ]);

        // Poison cache: same token id, but the cached copy claims a different client_id
        // than the one the JWT will assert. Middleware must fall through to DB.
        $otherClient = Client::factory()->create(['user_id' => $this->owner]);
        $poisoned = clone $realToken;
        $poisoned->client_id = $otherClient->getKey();
        $poisoned->setRelation('client', $otherClient);
        TokenCache::put($poisoned);

        // Request should still succeed because the DB fallback finds the real token
        // for the real client claimed by the JWT.
        $this->actingWithToken($realToken)->get(route('api.me'))->assertSuccessful();

        // Cache should now hold the real entry, not the poisoned one.
        $recovered = TokenCache::get($realToken->getKey());
        $this->assertNotNull($recovered);
        $this->assertSame((string) $this->client->getKey(), (string) $recovered->client_id);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        config_set('osu.oauth.token_cache_duration', 60);

        $this->owner = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->owner]);
    }

    private function makeToken(?User $user = null): Token
    {
        return $this->client->tokens()->create([
            'expires_at' => now()->addDay(),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['*'],
            'user_id' => ($user ?? User::factory()->create())->getKey(),
            'verified' => true,
        ]);
    }
}
