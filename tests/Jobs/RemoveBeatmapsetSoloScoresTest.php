<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\RemoveBeatmapsetSoloScores;
use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Group;
use App\Models\Language;
use App\Models\Solo\Score;
use App\Models\Solo\ScorePerformance;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupEvent;
use Tests\TestCase;

/**
 * @group EsSoloScores
 */
class RemoveBeatmapsetSoloScoresTest extends TestCase
{
    protected $connectionsToTransact = [];

    public function testHandle()
    {
        $beatmapset = Beatmapset::factory()->qualified()->has(Beatmap::factory()->qualified()->count(4))->create();
        $scores = array_map(
            fn (): Score => $this->createScore($beatmapset),
            array_fill(0, 10, null),
        );
        foreach ($scores as $i => $score) {
            $score->performance()->create(['pp' => rand(0, 1000)]);
        }
        $userAdditionalScores = array_map(
            fn (Score $score) => $this->createScore($beatmapset, $score->user_id, $score->ruleset_id),
            $scores,
        );

        $job = new RemoveBeatmapsetSoloScores($beatmapset);

        // These scores shouldn't be deleted
        for ($i = 0; $i < 10; $i++) {
            $score = $this->createScore($beatmapset);
            $score->performance()->create(['pp' => rand(0, 1000)]);
        }

        $this->expectCountChange(fn () => Score::count(), count($scores) * -2, 'removes scores');
        $this->expectCountChange(fn () => ScorePerformance::count(), count($scores) * -1, 'removes score performances');

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
