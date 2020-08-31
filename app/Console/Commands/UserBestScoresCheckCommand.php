<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

        $checker = new UserBestScoresCheck($user);
        $response = $checker->run($mode);

        $this->line("Found {$checker->esIdsFound} in index, {$checker->dbIdsFound} valid.");
        $this->line('Delete query response from elasticsearch:');
        $this->line(json_encode($response, JSON_PRETTY_PRINT));
    }
}
