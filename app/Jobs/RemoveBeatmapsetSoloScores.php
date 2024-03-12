<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Solo\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;

class RemoveBeatmapsetSoloScores implements ShouldQueue
{
    use Queueable;

    public $timeout = 3600;

    private int $beatmapsetId;
    private int $maxScoreId;
    private array $schemas;
    private ScoreSearch $scoreSearch;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
    {
        $this->beatmapsetId = $beatmapset->getKey();
        $this->maxScoreId = Score::max('id') ?? 0;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->scoreSearch = new ScoreSearch();
        $this->schemas = $this->scoreSearch->getActiveSchemas();

        $beatmapIds = Beatmap::where('beatmapset_id', $this->beatmapsetId)->pluck('beatmap_id');
        Score
            ::whereIn('beatmap_id', $beatmapIds)
            ->where('id', '<=', $this->maxScoreId)
            ->chunkById(1000, fn ($scores) => $this->deleteScores($scores));
    }

    private function deleteScores(Collection $scores): void
    {
        $ids = $scores->pluck('id')->all();

        Score::whereKey($ids)->update(['ranked' => false]);
        $this->scoreSearch->queueForIndex($this->schemas, $ids);
    }
}
