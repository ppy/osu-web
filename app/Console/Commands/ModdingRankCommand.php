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

use App\Models\Beatmap;
use App\Models\Beatmapset;
use Illuminate\Console\Command;

class ModdingRankCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'modding:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rank maps in queue.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Ranking beatmapsets...');

        $modeInts = array_values(Beatmap::MODES);

        shuffle($modeInts);

        foreach ($modeInts as $modeInt) {
            $this->waitRandom();
            $this->rankAll($modeInt);
        }

        $this->info('Done');
    }

    private function rankAll($modeInt)
    {
        $this->info('Ranking beatmapsets with at least mode: '.Beatmap::modeStr($modeInt));

        $rankedTodayCount = Beatmapset::ranked()
            ->withoutTrashed()
            ->withModesForRanking($modeInt)
            ->where('approved_date', '>=', now()->subDay())
            ->count();

        $rankableQuota = config('osu.beatmapset.rank_per_day') - $rankedTodayCount;

        $this->info("{$rankedTodayCount} beatmapsets ranked last 24 hours. Can rank {$rankableQuota} more");

        if ($rankableQuota <= 0) {
            return;
        }

        $toRankLimit = min(config('osu.beatmapset.rank_per_run'), $rankableQuota);

        $toBeRankedQuery = Beatmapset::qualified()
            ->withoutTrashed()
            ->withModesForRanking($modeInt)
            ->where('queued_at', '<', now()->subDays(7));

        $rankingQueue = $toBeRankedQuery->count();

        $toBeRanked = $toBeRankedQuery
            ->orderBy('queued_at', 'ASC')
            ->limit($toRankLimit)
            ->get();

        $this->info("{$rankingQueue} beatmapset(s) in ranking queue");
        $this->info("Ranking {$toBeRanked->count()} beatmapset(s)");

        foreach ($toBeRanked as $beatmapset) {
            $this->waitRandom();
            $this->info("Ranking beatmapset: {$beatmapset->getKey()}");
            $beatmapset->rank();
        }
    }

    private function waitRandom()
    {
        $delay = rand(5, 120);
        $this->info("Pausing for {$delay} seconds...");
        sleep($delay);
    }
}
