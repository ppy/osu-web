<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
