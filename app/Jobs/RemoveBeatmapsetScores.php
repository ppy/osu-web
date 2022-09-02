<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score\Best\Model as ScoreBestModel;
use App\Models\Solo\Score;
use App\Models\Solo\ScorePerformance;
use App\Models\UserStatistics;
use DB;
use Ds\Map;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use LaravelRedis;

class RemoveBeatmapsetScores implements ShouldQueue
{
    use Queueable;

    public $timeout = 3600;

    private int $beatmapsetId;
    private int $maxScoreId;
    private Map $userBestScores;
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
        $this->userBestScoresStoreKey = config('cache.prefix').':'.$this->beatmapsetId.':'.$this->maxScoreId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->restoreUserBestScores();
        $this->scoreSearch = new ScoreSearch();
        $this->schemas = $this->scoreSearch->getActiveSchemas();

        $beatmapIdsQuery = Beatmap::where('beatmapset_id', $this->beatmapsetId)->select('beatmap_id');
        Score
            ::with('performance')
            ->whereIn('beatmap_id', $beatmapIdsQuery)
            ->where('id', '<=', $this->maxScoreId)
            ->chunkById(1000, fn ($scores) => $this->deleteScores($scores));
        $this->updateAllUserStatistics();
    }

    private function deleteScores(Collection $scores): void
    {
        $ids = [];
        foreach ($scores as $score) {
            $this->updateUserBestScore($score);
            $ids[] = $score->getKey();
        }

        $scoresQuery = Score::whereKey($ids);
        // Queue delete ahead of time in case process is stopped right after
        // db delete is committed. It's fine queuing deleted score ahead of
        // time as best score check doesn't use index.
        // Set the flag first so indexer will correctly delete it.
        $scoresQuery->update(['preserve' => false]);
        $this->scoreSearch->queueForIndex($this->schemas, $ids);
        DB::transaction(function () use ($ids, $scoresQuery): void {
            ScorePerformance::whereKey($ids)->delete();
            $scoresQuery->delete();
        });
    }

    private function restoreUserBestScores(): void
    {
        $this->userBestScores = new Map(array_map(
            fn ($value) => json_decode($value, true),
            LaravelRedis::hgetall($this->userBestScoresStoreKey),
        ));
    }

    private function updateAllUserStatistics()
    {
        foreach ($this->userBestScores as $key => $scoreArray) {
            // delete ahead of time as - from user perspective - it's better
            // to have extra count than decrementing it twice.
            LaravelRedis::hdel($this->userBestScoresStoreKey, $key);

            $this->updateUserStatistics($scoreArray);
        }
    }

    private function updateUserBestScore(Score $score): void
    {
        // TODO: add legacy score check
        if (!$score->preserve) {
            return;
        }

        $beatmapId = $score->beatmap_id;
        $rulesetId = $score->ruleset_id;
        $userId = $score->user_id;
        $listKey = "{$userId}:{$beatmapId}:{$rulesetId}";

        $current = $this->userBestScores->get($listKey, null);

        $newData = $score->data;
        $newId = $score->getKey();

        if (
            $current !== null && (
            $current['total_score'] > $newData->totalScore ||
            ($current['total_score'] === $newData->totalScore && $current['id'] < $newId))
        ) {
            return;
        }

        $new = [
            'id' => $newId,
            'rank' => $newData->rank,
            'ruleset' => $score->getMode(),
            'total_score' => $newData->totalScore,
            'user_id' => $userId,
        ];
        $this->userBestScores->put($listKey, $new);
        LaravelRedis::hset($this->userBestScoresStoreKey, $listKey, json_encode($new));
    }

    private function updateUserStatistics(array $scoreArray): void
    {

        $statsColumn = ScoreBestModel::RANK_TO_STATS_COLUMN_MAPPING[$scoreArray['rank']] ?? null;

        if ($statsColumn === null) {
            return;
        }

        UserStatistics\Model
            ::getClass($scoreArray['ruleset'])
            ::whereKey($scoreArray['user_id'])
            ->update([$statsColumn => db_unsigned_increment($statsColumn, -1)]);
    }
}
