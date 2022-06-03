<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score\Best\Model as ScoreBestModel;
use App\Models\Solo\Score;
use App\Models\UserStatistics;
use Ds\Set;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;

class RemoveBeatmapsetScores implements ShouldQueue
{
    use Queueable;

    public $timeout = 3600;

    private int $beatmapsetId;
    private int $maxScoreId;
    private Set $resetUserRankStats;
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
        $this->resetUserRankStats = new Set();
        $this->scoreSearch = new ScoreSearch();
        $this->schemas = $this->scoreSearch->getActiveSchemas();

        Score::with('performance')->whereIn('beatmap_id', Beatmap::where('beatmapset_id', $this->beatmapsetId)->select('beatmap_id'))->where('id', '<=', $this->maxScoreId)->chunkById(1000, function (Collection $scores): void {
            foreach ($scores as $score) {
                $this->deleteScore($score);
            }
        });
    }

    private function deleteScore(Score $score): void
    {
        $this->resetUserRankStatsFor($score);
        $score->delete();
        $score->performance?->delete();
        $this->scoreSearch->queueForIndex($this->schemas, [$score->getKey()]);
    }

    private function resetUserRankStatsFor(Score $score): void
    {
        $beatmapId = $score->beatmap_id;
        $rulesetId = $score->ruleset_id;
        $userId = $score->user_id;
        $resetStatsKey = "{$userId}:{$beatmapId}:{$rulesetId}";

        if ($this->resetUserRankStats->contains($resetStatsKey)) {
            return;
        }

        $this->resetUserRankStats->add($resetStatsKey);

        $userBest = (new ScoreSearch(ScoreSearchParams::fromArray([
            'beatmap_ids' => [$beatmapId],
            'limit' => 1,
            'ruleset_id' => $rulesetId,
            'sort' => 'score_desc',
            'user_id' => $userId,
        ])))->records()[0] ?? null;

        if ($userBest === null) {
            return;
        }

        $statsColumn = ScoreBestModel::RANK_TO_STATS_COLUMN_MAPPING[$userBest->data->rank] ?? null;

        if ($statsColumn === null) {
            return;
        }

        UserStatistics\Model
            ::getClass($userBest->getMode())
            ::whereKey($userId)
            ->update([$statsColumn => db_unsigned_increment($statsColumn, -1)]);
    }
}
