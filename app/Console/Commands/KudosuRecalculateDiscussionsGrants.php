<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\BeatmapDiscussion;
use Illuminate\Console\Command;

class KudosuRecalculateDiscussionsGrants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kudosu:recalculate-discussions-grants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculates kudosu granted from beatmapset discussions.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->confirm('WARNING! This will recalculate kudosu from beatmap discussions with current thresholds. Continue?');

        if (!$continue) {
            $this->error('User aborted!');

            return;
        }

        $this->info('Recalculating kudosu grants...');
        $bar = $this->output->createProgressBar(BeatmapDiscussion::count());
        BeatmapDiscussion::chunk(1000, function ($discussions) use ($bar) {
            foreach ($discussions as $discussion) {
                $discussion->refreshKudosu('recalculate');
                $bar->advance();
            }
        });
        $bar->finish();
        $this->info(''); //newline for bar

        $this->info('Recalculation done!');
    }
}
