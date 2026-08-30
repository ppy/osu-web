<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\OAuth;

use App\Libraries\OAuth\AccessTokenRepository;
use App\Models\OAuth\Client;
use App\Models\OAuth\Token;
use App\Models\User;
use Laravel\Passport\Bridge\AccessTokenRepository as PassportAccessTokenRepository;
use Tests\TestCase;

class AccessTokenRepositoryTest extends TestCase
{
    protected AccessTokenRepository $repository;
    protected Client $client;
    protected User $user;

    public function testValidTokenIsExposed(): void
    {
        $token = $this->makeToken();

        $this->assertFalse($this->repository->isAccessTokenRevoked($token->getKey()));

        $loaded = AccessTokenRepository::loadedToken();
        $this->assertNotNull($loaded);
        $this->assertSame($token->getKey(), $loaded->getKey());
        $this->assertTrue($loaded->relationLoaded('client'));
    }

    public function testClientCredentialsTokenIsExposed(): void
    {
        $token = $this->makeToken(['user_id' => null, 'scopes' => ['public']]);

        $this->assertFalse($this->repository->isAccessTokenRevoked($token->getKey()));

        $loaded = AccessTokenRepository::loadedToken();
        $this->assertNotNull($loaded);
        $this->assertTrue($loaded->isClientCredentials());
    }

    public function testRevokedTokenIsConsideredRevoked(): void
    {
        $token = $this->makeToken(['revoked' => true]);

        $this->assertTrue($this->repository->isAccessTokenRevoked($token->getKey()));
        $this->assertNull(AccessTokenRepository::loadedToken());
    }

    public function testNonExistentTokenIsConsideredRevoked(): void
    {
        $this->assertTrue($this->repository->isAccessTokenRevoked('does-not-exist'));
        $this->assertNull(AccessTokenRepository::loadedToken());
    }

    public function testRevokedClientMakesTokenRevoked(): void
    {
        $token = $this->makeToken();
        $this->client->update(['revoked' => true]);

        $this->assertTrue($this->repository->isAccessTokenRevoked($token->getKey()));
        $this->assertNull(AccessTokenRepository::loadedToken());
    }

    public function testMiddlewareAcceptsValidToken(): void
    {
        $token = $this->makeToken();
        $this->actingWithToken($token)->get(route('api.me'))->assertSuccessful();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app(PassportAccessTokenRepository::class);
        $this->user = User::factory()->create();
        $this->client = Client::factory()->create(['user_id' => $this->user]);
    }

    protected function makeToken(array $overrides = []): Token
    {
        return $this->client->tokens()->create(array_merge([
            'expires_at' => now()->addDay(),
            'id' => uniqid(),
            'revoked' => false,
            'scopes' => ['*'],
            'user_id' => $this->user->getKey(),
            'verified' => true,
        ], $overrides));
    }
}
