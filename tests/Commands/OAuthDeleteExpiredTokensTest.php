<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

        $user = factory(User::class)->create();
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
