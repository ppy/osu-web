<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Jobs\EsIndexDocument;
use App\Libraries\FastRandom;
use App\Models\Beatmapset;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class BeatmapsetsBundle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beatmapsets:bundle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates bundled beatmapset listing to match osu!stable.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $toBundle = Beatmapset::esIndexingQuery()->findOrFail(config('osu.beatmapset.tutorial_ids'));
        $canBundle = Beatmapset::esIndexingQuery()
            ->canBundle()
            ->whereNotIn('beatmapset_id', config('osu.beatmapset.tutorial_ids'))
            ->orderBy('beatmapset_id')
            ->get();

        $now = Carbon::now('UTC');
        $rngSeed = $now->year * 1000 + intdiv($now->dayOfYear, 7);

        foreach (Beatmapset::BUNDLED_PER_MODE as $modeInt => $limit) {
            $random = new FastRandom($rngSeed);
            $toBundle = $toBundle->merge(
                $canBundle
                    ->filter(function ($beatmapset) use ($modeInt) {
                        return $beatmapset->beatmaps->contains('playmode', $modeInt);
                    })
                    ->sortBy(function () use ($random) {
                        return $random->nextDouble();
                    })
                    ->take($limit)
            );
        }

        // Beatmapsets with multiple modes may be added more than once
        $toBundle = $toBundle->unique('beatmapset_id');

        DB::transaction(function () use ($toBundle) {
            $beatmapsetsToIndex = $toBundle->merge(Beatmapset::esIndexingQuery()->bundled()->get());

            Beatmapset::bundled()->update(['bundled' => false]);
            Beatmapset::whereIn('beatmapset_id', $toBundle->pluck('beatmapset_id'))->update(['bundled' => true]);

            foreach ($beatmapsetsToIndex as $beatmapset) {
                dispatch(new EsIndexDocument($beatmapset));
            }
        });
    }
}
