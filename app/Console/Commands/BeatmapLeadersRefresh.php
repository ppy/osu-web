<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Beatmap;
use App\Models\BeatmapLeader;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class BeatmapLeadersRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beatmap-leaders:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh beatmap leaders table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->option('no-interaction') || $this->confirm('This will recalculate beatmap leaders, continue?', true);

        if (!$continue) {
            return $this->error('User aborted!');
        }

        $bar = $this->output->createProgressBar();

        Beatmap::select('beatmap_id')->scoreable()->chunkById(100, function (Collection $beatmaps) use ($bar): void {
            foreach ($beatmaps as $beatmap) {
                foreach (Beatmap::MODES as $ruleset => $rulesetId) {
                    BeatmapLeader::sync($beatmap->getKey(), $rulesetId);
                    $bar->advance();
                }
            }
        });
        $bar->finish();
        $this->line('');
    }
}
