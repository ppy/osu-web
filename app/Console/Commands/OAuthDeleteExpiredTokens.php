<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Laravel\Passport\Token;

/**
 * Removes expired tokens and auth codes from the OAuth tables.
 * It uses chunkById which is much slower than a straight batch delete, but doesn't lock the entire table while deleting.
 */
class OAuthDeleteExpiredTokens extends Command
{
    protected $signature = 'oauth:delete-expired-tokens';

    protected $description = 'Deletes expired OAuth tokens';

    /** @var \Carbon\Carbon */
    private $expiredBefore;

    public function handle()
    {
        $this->expiredBefore = now()->subDays(config('osu.oauth.retain_expired_tokens_days'));
        $this->line("Deleting before {$this->expiredBefore}");

        $this->deleteAuthCodes();
        $this->deleteAccessTokens();
        $this->deleteClientGrantTokens();
    }

    /**
     * Removes refresh tokens and associated access tokens.
     *
     * @return void
     */
    private function deleteAccessTokens()
    {
        $refreshTokensQuery = DB::table('oauth_refresh_tokens')
            ->where('expires_at', '<', $this->expiredBefore)
            ->select('id', 'access_token_id', 'expires_at');
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
        }, 'expires_at');

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$accessTokensDeleted} expired access tokens.");
        $this->line("Deleted {$refreshTokensDeleted} expired refresh tokens.");
    }

    /**
     * Removes auth codes.
     *
     * @return void
     */
    private function deleteAuthCodes()
    {
        $query = DB::table('oauth_auth_codes')->where('expires_at', '<', $this->expiredBefore)->select('id', 'expires_at');
        $total = (clone $query)->count();

        $progress = $this->output->createProgressBar($total);
        $progress->setFormat('very_verbose');

        $deleted = 0;
        $query->chunkById(1000, function ($chunk) use (&$deleted, $progress) {
            $deleted += DB::table('oauth_auth_codes')->whereIn('id', $chunk->pluck('id'))->delete();
            $progress->advance($chunk->count());
        }, 'expires_at');

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$deleted} expired auth codes.");
    }

    /**
     * Removes client credential grant tokens. These are access tokens with no associated user id.
     *
     * @return void
     */
    private function deleteClientGrantTokens()
    {
        $query = Token::where('user_id', null)->where('expires_at', '<', $this->expiredBefore)->select('id', 'expires_at');
        $total = (clone $query)->count();

        $progress = $this->output->createProgressBar($total);
        $progress->setFormat('very_verbose');

        $deleted = 0;
        $query->chunkById(1000, function ($chunk) use (&$deleted, $progress) {
            $deleted += Token::whereIn('id', $chunk->pluck('id'))->delete();
            $progress->advance($chunk->count());
        }, 'expires_at');

        $progress->finish();
        $this->line('');
        $this->line("Deleted {$deleted} expired auth codes.");
    }
}
