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
use App\Models\BeatmapsetEvent;
use App\Models\KudosuHistory;
use App\Models\User;
use DB;
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
        $continue = $this->confirm('WARNING! This will remove ALL kudosu granted from beatmap discussions and recalculate them with current thresholds. Continue?');

        if (!$continue) {
            $this->error('User aborted!');

            return;
        }

        DB::transaction(function () {
            $this->info('Reverting user kudosu balance...');
            $kudosuGrants = KudosuHistory::where('kudosuable_type', 'App\Models\BeatmapDiscussion')
                ->select('receiver_id')
                ->selectRaw('sum(amount) as kudosu_change')
                ->groupBy('receiver_id')
                ->get();

            $bar = $this->output->createProgressBar($kudosuGrants->count());
            foreach ($kudosuGrants as $grant) {
                User::find($grant->receiver_id)->update([
                    'osu_kudostotal' => DB::raw("osu_kudostotal - {$grant->kudosu_change}"),
                    'osu_kudosavailable' => DB::raw("osu_kudosavailable - {$grant->kudosu_change}"),
                ]);
                $bar->advance();
            }
            $bar->finish();
            $this->info(''); //newline for bar

            $this->info('Removing all [KudosuHistory] and [BeatmapsetEvent] records...');
            KudosuHistory::where('kudosuable_type', 'App\Models\BeatmapDiscussion')->delete();
            BeatmapsetEvent::whereIn('type', ['kudosu_gain', 'kudosu_lost'])->delete();
            BeatmapDiscussion::whereNotNull('kudosu_refresh_votes')->update(['kudosu_refresh_votes' => null]); // mainly 'cuz we can't just BeatmapDiscussion::update()

            $this->info('Recalculating kudosu grants...');
            $bar = $this->output->createProgressBar(BeatmapDiscussion::count());
            BeatmapDiscussion::chunk(1000, function ($discussions) use ($bar) {
                foreach ($discussions as $discussion) {
                    $discussion->refreshKudosu('vote');
                    $bar->advance();
                }
            });
            $bar->finish();
            $this->info(''); //newline for bar

            $this->info('Recalculation done!');
        });
    }
}
