<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\RemoveBeatmapsetScores;
use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\Score\Best\Model as BestModel;
use App\Models\Solo\Score;
use App\Models\Solo\ScorePerformance;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use App\Models\UserStatistics;
use Tests\TestCase;

/**
 * @group EsSoloScores
 */
class RemoveBeatmapsetScoresTest extends TestCase
{
    protected $connectionsToTransact = [];

    public function testHandle()
    {
        $beatmapset = Beatmapset::factory()->qualified()->has(Beatmap::factory()->qualified()->count(4))->create();
        $scores = array_map(
            fn (): Score => $this->createScore($beatmapset),
            array_fill(0, 10, null),
        );
        $userAdditionalScores = array_map(
            fn (Score $score) => $this->createScore($beatmapset, $score->user_id, $score->ruleset_id),
            $scores,
        );
        foreach ($scores as $i => $score) {
            $additionalScore = $userAdditionalScores[$i];
            $score->performance()->create(['pp' => rand(0, 1000)]);
            $bestScore = $score->data->totalScore >= $additionalScore->data->totalScore
                ? $score
                : $additionalScore;
            $updatedColumn = BestModel::RANK_TO_STATS_COLUMN_MAPPING[$bestScore->data->rank];
            $statistics = $bestScore
                ->user
                ->statistics($bestScore->getMode(), true)
                ->firstOrCreate();
            $statistics->update([$updatedColumn => db_unsigned_increment($updatedColumn, 1)]);
            foreach (BestModel::RANK_TO_STATS_COLUMN_MAPPING as $column) {
                $change = $updatedColumn === $column ? -1 : 0;
                $this->expectCountChange(fn () => $statistics->fresh()->$column, $change, "user statistics ({$change})");
            }
        }

        $job = new RemoveBeatmapsetScores($beatmapset);

        // These scores shouldn't be deleted
        for ($i = 0; $i < 10; $i++) {
            $this->createScore($beatmapset);
        }

        $this->expectCountChange(fn () => Score::count(), count($scores) * -2);

        static::reindexScores();

        $job->handle();

        $search = new ScoreSearch();
        // this also makes sure the job deletes scores from index
        $search->indexWait();

        $this->beforeApplicationDestroyed(function () use ($search) {
            $this->refreshApplication();
            $db = app('db');
            Beatmap::truncate();
            Beatmapset::truncate();
            Country::truncate();
            Genre::truncate();
            Group::truncate();
            Language::truncate();
            Score::truncate();
            ScorePerformance::truncate();
            User::truncate();
            UserGroup::truncate();
            UserGroupEvent::truncate();
            UserStatistics\Fruits::truncate();
            UserStatistics\Mania::truncate();
            UserStatistics\Osu::truncate();
            UserStatistics\Taiko::truncate();
            $search->deleteAll();
            foreach (config('database.connections') as $name => $_dbConfig) {
                $conn = $db->connection($name);
                $conn->rollBack();
                $conn->disconnect();
            }
        });
    }

    private function createScore(Beatmapset $beatmapset, ?int $userId = null, ?int $rulesetId = null): Score
    {
        $params = [
            'beatmap_id' => array_rand_val($beatmapset->beatmaps),
            'preserve' => true,
        ];
        if ($userId !== null) {
            $params['user_id'] = $userId;
        }
        if ($rulesetId !== null) {
            $params['ruleset_id'] = $rulesetId;
        }

        return Score::factory()->withData([
            'rank' => array_rand_val(['A', 'S', 'SH', 'X', 'XH']),
        ])->create($params);
    }
}
