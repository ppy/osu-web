<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Score\Best;

use App\Models\Beatmap;
use App\Models\Score\Best\Model;
use App\Models\UserStatistics;
use Tests\TestCase;

class ModelTest extends TestCase
{
    private static function getRandomMode(): string
    {
        return array_rand(Beatmap::MODES);
    }

    public function testDelete()
    {
        $class = Model::getClassByString(static::getRandomMode());
        $score = $class::factory()->create();

        $initialCount = $class::count();

        $score->delete();

        $this->assertSame($initialCount - 1, $class::count());
    }

    public function testDeleteAlsoDecrementUserRankCount()
    {
        $mode = static::getRandomMode();
        $class = Model::getClassByString($mode);
        $score = $class::factory()->create(['rank' => 'X']);
        $statsClass = UserStatistics\Model::getClass($mode);
        $stats = factory($statsClass)->create([
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $initialRankCount = $stats->x_rank_count;

        $score->delete();

        $this->assertSame($initialRankCount - 1, $stats->fresh()->x_rank_count);
    }

    public function testDeleteNonPersonalBestKeepUserRankCount()
    {
        $mode = static::getRandomMode();
        $class = Model::getClassByString($mode);
        $bestScore = $class::factory()->create(['rank' => 'X']);
        $score = $class::factory()->create([
            'beatmap_id' => $bestScore->beatmap_id,
            'rank' => 'A',
            'score' => $bestScore->score - 10,
            'user_id' => $bestScore->user_id,
        ]);
        $statsClass = UserStatistics\Model::getClass($mode);
        $stats = factory($statsClass)->create([
            'a_rank_count' => 10,
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $initialXRankCount = $stats->x_rank_count;
        $initialARankCount = $stats->a_rank_count;

        $score->delete();

        $this->assertSame($initialARankCount, $stats->fresh()->a_rank_count);
        $this->assertSame($initialXRankCount, $stats->fresh()->x_rank_count);
    }

    public function testDeletePersonalBestUpdateUserRankCountWhenThereIsOtherScore()
    {
        $mode = static::getRandomMode();
        $class = Model::getClassByString($mode);
        $bestScore = $class::factory()->create(['rank' => 'X']);
        $score = $class::factory()->create([
            'beatmap_id' => $bestScore->beatmap_id,
            'rank' => 'A',
            'score' => $bestScore->score - 10,
            'user_id' => $bestScore->user_id,
        ]);
        $statsClass = UserStatistics\Model::getClass($mode);
        $stats = factory($statsClass)->create([
            'a_rank_count' => 10,
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $initialXRankCount = $stats->x_rank_count;
        $initialARankCount = $stats->a_rank_count;

        $bestScore->delete();

        $this->assertSame($initialARankCount + 1, $stats->fresh()->a_rank_count);
        $this->assertSame($initialXRankCount - 1, $stats->fresh()->x_rank_count);
    }
}
