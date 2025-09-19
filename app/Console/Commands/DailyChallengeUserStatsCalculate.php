<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\DailyChallengeUserStats;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class DailyChallengeUserStatsCalculate extends Command
{
    protected $signature = 'daily-challenge:user-stats-calculate';

    protected $description = "Calculate user stats from the result of previous day's daily challenge";

    public function handle(): void
    {
        DailyChallengeUserStats::calculate(CarbonImmutable::today()->subDays(1));
    }
}
