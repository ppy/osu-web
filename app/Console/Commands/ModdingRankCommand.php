<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            ->where('queued_at', '<', now()->subDays(config('osu.beatmapset.minimum_days_for_rank')));

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
