<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\DailyChallengeUserStats;
use Illuminate\Console\Command;

class DailyChallengeUserStatsRecalculate extends Command
{
    protected $signature = 'daily-challenge:user-stats-recalculate {--all} {id?*}';

    protected $description = 'Recalculate user daily challenge stats';

    public function handle(): int
    {
        $isAll = $this->option('all');
        $userIds = $this->argument('id');

        if (count($userIds) > 0 && $isAll) {
            $this->error("can't specify both user ids and all option");

            return 1;
        }

        if (count($userIds) === 0 && !$isAll) {
            $this->error('either user ids or all option is required');

            return 1;
        }

        if ($isAll) {
            DailyChallengeUserStats::chunkById(100, function ($statsArray) {
                $this->process($statsArray->keyBy('user_id')->all(), true);
            });
        } else {
            $statsByUserId = DailyChallengeUserStats::find($userIds)->keyBy('user_id');
            $statsArray = [];
            foreach ($userIds as $userId) {
                $statsArray[$userId] = $statsByUserId[$userId] ?? null;
            }

            $this->process($statsArray, false);
        }

        return 0;
    }

    private function process(array $statsArray, bool $isAll): void
    {
        $verbose = $this->option('verbose') || !$isAll;

        foreach ($statsArray as $userId => $stats) {
            if ($stats === null) {
                if ($verbose) {
                    $this->info("User {$userId}: no stats");
                }
                continue;
            }

            $origAttributes = $stats->getAttributes();
            $stats->fix();

            if ($origAttributes === $stats->getAttributes()) {
                if ($verbose) {
                    $this->info("User {$userId}: no change");
                }
            } else {
                $this->info("User {$userId}: updated");
            }
        }
    }
}
