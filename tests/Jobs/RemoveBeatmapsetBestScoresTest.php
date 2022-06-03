<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\RemoveBeatmapsetBestScores;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score\Best\Model as BestModel;
use Tests\TestCase;

class RemoveBeatmapsetBestScoresTest extends TestCase
{
    public function testHandle()
    {
        $beatmapset = Beatmapset::factory()->qualified()->has(Beatmap::factory()->qualified()->count(4))->create();
        $scores = array_map(
            fn () => $this->createScore($beatmapset),
            array_fill(0, 10, null),
        );

        $job = new RemoveBeatmapsetBestScores($beatmapset);

        // These scores shouldn't be deleted
        $postJobScores = array_map(
            fn () => $this->createScore($beatmapset),
            array_fill(0, 10, null),
        );

        $this->expectCountChange(fn () => array_reduce(
            array_keys(Beatmap::MODES),
            fn (int $carry, string $ruleset) => $carry + BestModel::getClassByString($ruleset)::count(),
            0,
        ), count($scores) * -1);

        $job->handle();
    }

    private function createScore(Beatmapset $beatmapset): BestModel
    {
        $beatmap = array_rand_val($beatmapset->beatmaps);
        $class = BestModel::getClassByString(array_rand(Beatmap::MODES));

        return $class::factory()->create(['beatmap_id' => $beatmap]);
    }
}
