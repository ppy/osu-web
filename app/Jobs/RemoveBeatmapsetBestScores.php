<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\ReplayViewCount;
use App\Models\Score\Best\Model;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class RemoveBeatmapsetBestScores implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 36000;
    public $beatmapset;
    public $maxScoreIds = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
    {
        $this->beatmapset = $beatmapset;

        foreach (Beatmap::MODES as $mode => $_modeInt) {
            $this->maxScoreIds[$mode] = Model::getClass($mode)::max('score_id');
        }
    }

    public function displayName()
    {
        return static::class." (Beatmapset {$this->beatmapset->getKey()})";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $beatmapIds = model_pluck($this->beatmapset->beatmaps(), 'beatmap_id');

        foreach (Beatmap::MODES as $mode => $_modeInt) {
            $scoreClass = Model::getClass($mode);
            $replayViewCountClass = ReplayViewCount\Model::getClass($mode);

            $query = $scoreClass
                ::with('user')
                ->whereIn('beatmap_id', $beatmapIds)
                ->where('score_id', '<=', $this->maxScoreIds[$mode] ?? 0)
                ->select('score_id')
                ->chunkById(1000, function ($scores) use ($replayViewCountClass, $scoreClass) {
                    $ids = $scores->pluck('score_id')->all();
                    $scoreClass::whereKey($ids)->delete();
                    $replayViewCountClass::whereKey($ids)->delete();
                    // the actual replay file is deleted by non-legacy score deletion job
                });
        }
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping((string) $this->beatmapset->getKey(), $this->timeout, $this->timeout)];
    }
}
