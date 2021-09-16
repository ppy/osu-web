<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Models\Beatmapset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckBeatmapsetCovers implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $beatmapset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
    {
        $this->beatmapset = $beatmapset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // trigger a cover regeneration if any cover images are missing
        if (!$this->beatmapset->allCoverImagesPresent()) {
            $job = (new RegenerateBeatmapsetCover($this->beatmapset))->onQueue('beatmap_high');
            dispatch($job);
        }
    }
}
