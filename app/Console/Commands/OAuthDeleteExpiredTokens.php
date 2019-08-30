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

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Laravel\Passport\Token;

class OAuthDeleteExpiredTokens extends Command
{
    protected $signature = 'oauth:delete-expired-tokens';

    protected $description = 'Deletes expired OAuth tokens';

    /** @var \Carbon\Carbon */
    private $expiredBefore;

    public function handle()
    {
        $this->expiredBefore = now()->subDays(config('osu.oauth.retain_expired_tokens_days'));

        $this->deleteAuthCodes();
        $this->deleteAccessTokens();
        $this->deleteClientGrantTokens();
    }

    /**
     * Removes refresh tokens and associated access tokens.
     *
     * It uses chunkById which is much slower than a straight batch delete, but doesn't lock the entire table while deleting.
     *
     * @return void
     */
    private function deleteAccessTokens()
    {
        $refreshTokensQuery = DB::table('oauth_refresh_tokens')
            ->where('expires_at', '<', $this->expiredBefore)
            ->select('id', 'access_token_id');
        $refreshTokensTotal = (clone $refreshTokensQuery)->count();

        $progress = $this->output->createProgressBar($refreshTokensTotal);
        $progress->setFormat('very_verbose');

        $accessTokensDeleted = 0;
        $refreshTokensDeleted = 0;
        $refreshTokensQuery->chunkById(1000, function ($chunk) use (&$accessTokensDeleted, &$refreshTokensDeleted, $progress) {
            // This assumes the refresh token always has a longer valid lifetime than the access token.
            $accessTokensDeleted += Token::whereIn('id', $chunk->pluck('access_token_id'))->delete();
            $refreshTokensDeleted += DB::table('oauth_refresh_tokens')->whereIn('id', $chunk->pluck('id'))->delete();
            $progress->advance($chunk->count());
        });

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$accessTokensDeleted} expired access tokens.");
        $this->line("Deleted {$refreshTokensDeleted} expired refresh tokens.");
    }

    private function deleteAuthCodes()
    {
        $count = DB::table('oauth_auth_codes')->where('expires_at', '<', $this->expiredBefore)->delete();
        $this->line("Deleted {$count} expired auth codes.");
    }

    private function deleteClientGrantTokens()
    {
        $count = Token::where('user_id', null)->where('expires_at', '<', $this->expiredBefore)->delete();
        $this->line("Deleted {$count} expired client credential grant tokens.");
    }
}
