<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Models\BeatmapDiscussion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshBeatmapsetUserKudosu implements ShouldQueue
{
    use Queueable;

    protected $beatmapsetId;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->beatmapsetId = $params['beatmapsetId'];
        $this->userId = $params['userId'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        BeatmapDiscussion
            ::where('beatmapset_id', $this->beatmapsetId)
            ->where('user_id', $this->userId)
            ->chunkById(1000, function ($chunk) {
                $chunk->each->refreshKudosu('recalculate');
            });
    }
}
