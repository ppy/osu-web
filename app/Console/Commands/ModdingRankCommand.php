<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Libraries\Ruleset;
use App\Models\Beatmapset;
use Illuminate\Console\Command;

class ModdingRankCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'modding:rank {--no-wait} {--count-only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rank maps in queue.';

    private bool $countOnly = false;
    private bool $noWait = false;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->countOnly = get_bool($this->option('count-only'));
        $this->noWait = get_bool($this->option('no-wait'));

        if ($this->countOnly) {
            $this->info('Number of beatmapsets in queue:');
        } else {
            $this->info('Ranking beatmapsets...');
        }

        $rulesets = Ruleset::cases();

        shuffle($rulesets);

        foreach ($rulesets as $ruleset) {
            $this->waitRandom();

            if ($this->countOnly) {
                $count = Beatmapset::toBeRanked($ruleset)->count();
                $this->info("{$ruleset->name}: {$count}");
            } else {
                $this->rankAll($ruleset);
            }
        }

        $this->info('Done');
    }

    private function rankAll(Ruleset $ruleset)
    {
        $this->info("Ranking beatmapsets with at least mode: {$ruleset->name}");

        $rankedTodayCount = Beatmapset::ranked()
            ->withoutTrashed()
            ->withModesForRanking($ruleset->value)
            ->where('approved_date', '>=', now()->subDays())
            ->count();

        $rankableQuota = config('osu.beatmapset.rank_per_day') - $rankedTodayCount;

        $this->info("{$rankedTodayCount} beatmapsets ranked last 24 hours. Can rank {$rankableQuota} more");

        if ($rankableQuota <= 0) {
            return;
        }

        $toRankLimit = min(config('osu.beatmapset.rank_per_run'), $rankableQuota);

        $toBeRankedQuery = Beatmapset::toBeRanked($ruleset);

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
        if ($this->noWait || $this->countOnly) {
            return;
        }

        $delay = rand(5, 120);
        $this->info("Pausing for {$delay} seconds...");
        sleep($delay);
    }
}
