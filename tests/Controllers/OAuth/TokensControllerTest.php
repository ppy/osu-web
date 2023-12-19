<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\OAuth;

use App\Libraries\OAuth\EncodeToken;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\OAuth\Token;
use App\Models\User;
use Database\Factories\OAuth\ClientFactory;
use Database\Factories\OAuth\RefreshTokenFactory;
use Database\Factories\UserFactory;
use Tests\TestCase;

class TokensControllerTest extends TestCase
{
    public static function dataProviderForTestIssueTokenWithRefreshTokenInheritsVerified(): array
    {
        return [
            [true],
            [false],
        ];
    }

    public function testDestroyCurrent()
    {
        $refreshToken = (new RefreshTokenFactory())->create();
        $token = $refreshToken->accessToken;

        $this
            ->actingWithToken($token)
            ->json('DELETE', route('api.oauth.tokens.current'))
            ->assertSuccessful();

        $this->assertTrue($token->fresh()->revoked);
        $this->assertTrue($refreshToken->fresh()->revoked);
    }

    public function testDestroyCurrentClientGrant()
    {
        $token = Token::factory()->create(['user_id' => null]);

        $this
            ->actingWithToken($token)
            ->json('DELETE', route('api.oauth.tokens.current'))
            ->assertSuccessful();

        $this->assertTrue($token->fresh()->revoked);
    }

    public function testIssueTokenWithPassword(): void
    {
        \Mail::fake();

        $user = User::factory()->create();
        $client = (new ClientFactory())->create([
            'password_client' => true,
        ]);

        $this->expectCountChange(fn () => $user->tokens()->count(), 1);

        $tokenJson = $this->json('POST', route('oauth.passport.token'), [
            'grant_type' => 'password',
            'client_id' => $client->getKey(),
            'client_secret' => $client->secret,
            'scope' => '*',
            'username' => $user->username,
            'password' => UserFactory::DEFAULT_PASSWORD,
        ])->assertSuccessful()
        ->decodeResponseJson();

        $this->json('GET', route('api.me'), [], [
            'Authorization' => "Bearer {$tokenJson['access_token']}",
        ])->assertSuccessful()
        ->assertJsonPath('session_verified', false);

        // unverified access to api should trigger this but not necessarily return 401
        \Mail::assertQueued(UserVerificationMail::class);
    }

    /**
     * @dataProvider dataProviderForTestIssueTokenWithRefreshTokenInheritsVerified
     */
    public function testIssueTokenWithRefreshTokenInheritsVerified(bool $verified): void
    {
        \Mail::fake();

        $refreshToken = (new RefreshTokenFactory())->create();
        $accessToken = $refreshToken->accessToken;
        $accessToken->forceFill(['scopes' => ['*'], 'verified' => $verified])->save();
        $client = $accessToken->client;
        $user = $accessToken->user;
        $refreshTokenString = EncodeToken::encodeRefreshToken($refreshToken, $accessToken);

        $this->expectCountChange(fn () => $user->tokens()->count(), 1);

        $tokenJson = $this->json('POST', route('oauth.passport.token'), [
            'grant_type' => 'refresh_token',
            'client_id' => $client->getKey(),
            'client_secret' => $client->secret,
            'refresh_token' => $refreshTokenString,
            'scope' => implode(' ', $accessToken->scopes),
        ])->assertSuccessful()
        ->decodeResponseJson();

        $this->json('GET', route('api.me'), [], [
            'Authorization' => "Bearer {$tokenJson['access_token']}",
        ])->assertSuccessful()
        ->assertJsonPath('session_verified', $verified);

        \Mail::assertQueued(UserVerificationMail::class, $verified ? 0 : 1);
    }
}
