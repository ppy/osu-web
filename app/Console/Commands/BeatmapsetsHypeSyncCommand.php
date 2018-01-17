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
