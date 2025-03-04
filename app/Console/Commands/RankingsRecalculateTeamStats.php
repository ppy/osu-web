<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Beatmap;
use App\Models\Team;
use App\Models\TeamStatistics;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

class RankingsRecalculateTeamStats extends Command
{
    protected $signature = 'rankings:recalculate-team-stats';
    protected $description = 'Recalculates team stats from the lastest data.';

    private ProgressBar $bar;

    public function handle()
    {
        $this->bar = $this->output->createProgressBar();

        $teams = Team::chunkById(100, function ($teamChunk) {
            foreach ($teamChunk as $team) {
                foreach (Beatmap::MODES as $rulesetId) {
                    TeamStatistics::createOrFirst([
                        'team_id' => $team->getKey(),
                        'ruleset_id' => $rulesetId,
                    ])->recalculate();
                    $this->bar->advance();
                }
            }
        });

        TeamStatistics::doesntHave('team')->delete();

        $this->bar->finish();
        $this->line('');
    }
}
