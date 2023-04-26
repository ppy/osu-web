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
    private static function getRandomRuleset(): string
    {
        return array_rand(Beatmap::MODES);
    }

    public function testDelete()
    {
        $class = Model::getClass(static::getRandomRuleset());
        $score = $class::factory()->create();

        $this->expectCountChange(fn () => $class::count(), -1);

        $score->delete();
    }

    public function testDeleteAlsoDecrementUserRankCount()
    {
        $ruleset = static::getRandomRuleset();
        $class = Model::getClass($ruleset);
        $score = $class::factory()->create(['rank' => 'X']);
        $stats = UserStatistics\Model::getClass($ruleset)::factory()->create([
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $this->expectCountChange(fn () => $stats->fresh()->x_rank_count, -1);

        $score->delete();
    }

    public function testDeleteNonPersonalBestKeepUserRankCount()
    {
        $ruleset = static::getRandomRuleset();
        $class = Model::getClass($ruleset);
        $bestScore = $class::factory()->create(['rank' => 'X']);
        $score = $class::factory()->create([
            'beatmap_id' => $bestScore->beatmap_id,
            'rank' => 'A',
            'score' => $bestScore->score - 10,
            'user_id' => $bestScore->user_id,
        ]);
        $stats = UserStatistics\Model::getClass($ruleset)::factory()->create([
            'a_rank_count' => 10,
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $this->expectCountChange(fn () => $stats->fresh()->a_rank_count, 0);
        $this->expectCountChange(fn () => $stats->fresh()->x_rank_count, 0);

        $score->delete();
    }

    public function testDeletePersonalBestUpdateUserRankCountWhenThereIsOtherScore()
    {
        $ruleset = static::getRandomRuleset();
        $class = Model::getClass($ruleset);
        $bestScore = $class::factory()->create(['rank' => 'X']);
        $score = $class::factory()->create([
            'beatmap_id' => $bestScore->beatmap_id,
            'rank' => 'A',
            'score' => $bestScore->score - 10,
            'user_id' => $bestScore->user_id,
        ]);
        $stats = UserStatistics\Model::getClass($ruleset)::factory()->create([
            'a_rank_count' => 10,
            'user_id' => $score->user_id,
            'x_rank_count' => 10,
        ]);

        $this->expectCountChange(fn () => $stats->fresh()->a_rank_count, 1);
        $this->expectCountChange(fn () => $stats->fresh()->x_rank_count, -1);

        $bestScore->delete();
    }
}
