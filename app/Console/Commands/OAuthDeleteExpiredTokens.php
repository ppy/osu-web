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

use Illuminate\Console\Command;
use Laravel\Passport\Token;

class OAuthDeleteExpiredTokens extends Command
{
    protected $signature = 'oauth:delete-expired-tokens';

    protected $description = 'Deletes expired OAuth tokens';

    public function handle()
    {
        $count = Token
            ::where(
                'expires_at',
                '<',
                now()->subDays(config('osu.oauth.retain_expired_tokens_days'))
            )->delete();

        $this->line("Deleted {$count} expired tokens.");
    }
}
