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

use App\Libraries\UserBestScoresCheck;
use App\Models\User;
use Illuminate\Console\Command;

class UserBestScoresCheckCommand extends Command
{
    protected $signature = 'user:check-best-scores {userId} {mode}';

    protected $description = 'Removes the best scores for a given user from elasticsearch if it no longer exists in the database.';

    public function handle()
    {
        $mode = $this->argument('mode');
        $user = User::findOrFail($this->argument('userId'));

        $response = (new UserBestScoresCheck($user))->run($mode);

        $this->line(json_encode($response, JSON_PRETTY_PRINT));
    }
}
