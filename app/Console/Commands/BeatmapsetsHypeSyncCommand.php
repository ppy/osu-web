<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use Illuminate\Console\Command;

class BeatmapsetsHypeSyncCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'beatmapsets:hypesync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronises hype and nomination count caches for all beatmapsets.';

    private $progress;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Synchronising hype and nomination counts...');

        $beatmapsets = Beatmapset::whereIn('beatmapset_id', BeatmapDiscussion::select('beatmapset_id')->distinct());
        $this->progress = $this->output->createProgressBar($beatmapsets->count());

        $beatmapsets->chunkById(1000, function ($sets) {
            foreach ($sets as $set) {
                $set->refreshCache();
                $this->progress->advance();
            }
        });

        $this->progress->finish();
    }
}
