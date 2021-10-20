<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Models\User;
use DB;
use Laravel\Passport\Token;
use Tests\TestCase;

class OAuthDeleteExpiredTokensTest extends TestCase
{
    public function testDeleteAccessTokens()
    {
        config()->set('osu.oauth.retain_expired_tokens_days', 0);

        $user = User::factory()->create();
        $tokenAttributes = [
            'client_id' => 1, // irrelevant.
            'expires_at' => now()->subDays(1),
            'revoked' => false,
            'scopes' => ['identify'],
            'user_id' => $user->getKey(),
        ];
        $token1 = Token::create(array_merge(['id' => 1], $tokenAttributes));
        $token2 = Token::create(array_merge(['id' => 2], $tokenAttributes));

        DB::table('oauth_refresh_tokens')->insert([
            'access_token_id' => $token1->id,
            'expires_at' => now()->subDays(1),
            'id' => 1,
            'revoked' => 0,
        ]);

        DB::table('oauth_refresh_tokens')->insert([
            'access_token_id' => $token2->id,
            'expires_at' => now()->addDays(1),
            'id' => 2,
            'revoked' => 0,
        ]);

        $this->artisan('oauth:delete-expired-tokens');

        $this->assertNull(Token::find($token1->id));
        $this->assertNotNull(Token::find($token2->id));
    }
}
