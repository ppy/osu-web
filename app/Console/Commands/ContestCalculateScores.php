<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Contest;
use Illuminate\Console\Command;

class ContestCalculateScores extends Command
{
    protected $description = 'Calculated standardised scores for judged contests.';
    protected $signature = 'contest:calculate-scores {contestId}';

    public function handle()
    {
        $contestId = get_int($this->argument('contestId'));
        if ($contestId === null) {
            $this->error('Contest id is required.');
            return static::INVALID;
        }

        $contest = Contest::findOrFail($contestId);
        if (!$contest->isScoreStandardised()) {
            $this->error('Contest does not use standardised scoring.');
            return static::FAILURE;
        }

        $contest->calculateScoresStd();
    }
}
