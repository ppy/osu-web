<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Libraries\Score\TopPlays;
use App\Models\Beatmap;
use Illuminate\Console\Command;

class RankingsRecalculateTopPlays extends Command
{
    protected $description = 'Recalculates top plays from the lastest data.';
    protected $signature = 'rankings:recalculate-top-plays';

    public function handle()
    {
        foreach (Beatmap::MODES as $rulesetName => $rulesetId) {
            $this->info("Updating top plays data for {$rulesetName}");
            new TopPlays($rulesetId)->updateCache();
        }
        $this->info('Done');
    }
}
