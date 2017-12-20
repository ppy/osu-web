<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class UserRecalculateRankCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:recalculate-rank-counts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate rank counts for user statistics.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->confirm('This will recalculate and update the rank counts for user statistics, continue?');

        if (!$continue) {
            return $this->error('User aborted!');
        }

        $start = time();

        $users = User::withoutGlobalScopes();
        $users->chunkById(1000, function ($chunk) {
            foreach ($chunk as $user) {
                $this->process($user);
            }
        }, 'user_id');
    }

    private function process($user)
    {
        // var_dump($user->user_id);
        $this->rankCounts($user->scoresBestOsu());
        $this->rankCounts($user->scoresBestFruits());
        $this->rankCounts($user->scoresBestMania());
        $this->rankCounts($user->scoresBestTaiko());
    }

    private function rankCounts($scores)
    {
        $counts = $scores->rankCounts();
        $values = array_values($counts)[0] ?? [];

        return [
            'XH' => $values['XH'] ?? 0,
            'SH' => $values['SH'] ?? 0,
            'X' => $values['X'] ?? 0,
            'S' => $values['S'] ?? 0,
            'A' => $values['A'] ?? 0,
        ];
    }
}
