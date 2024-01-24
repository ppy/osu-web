<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Score as LegacyScore;
use App\Models\ScoreToken;
use App\Models\Solo\Score;
use App\Models\User;
use LaravelRedis;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testStore()
    {
        $scoreToken = ScoreToken::factory()->create();
        $legacyScoreClass = LegacyScore\Model::getClassByRulesetId($scoreToken->beatmap->playmode);

        $this->expectCountChange(fn () => Score::count(), 1);
        $this->expectCountChange(fn () => $legacyScoreClass::count(), 1);
        $this->expectCountChange(fn () => $this->processingQueueCount(), 1);

        $this->actAsScopedUser($scoreToken->user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $scoreToken->beatmap->getKey(),
                'token' => $scoreToken->getKey(),
            ]),
            [
                'accuracy' => 1,
                'max_combo' => 10,
                'mods' => [
                    ['acronym' => 'DT'],
                ],
                'passed' => true,
                'rank' => 'A',
                'statistics' => ['Good' => 1],
                'total_score' => 10,
            ]
        )->assertSuccessful()
        ->assertJsonFragment(['build_id' => $scoreToken->build_id]);

        $score = $scoreToken->fresh()->score;
        $this->assertNotNull($score);
        $this->assertSame(1, count($score->data->mods));
    }

    public function testStoreCompleted()
    {
        $scoreToken = ScoreToken::factory()->create();
        $score = Score::factory()->create(['beatmap_id' => $scoreToken->beatmap_id]);
        $scoreToken->update(['score_id' => $score->getKey()]);

        $this->expectCountChange(fn () => Score::count(), 0);
        $this->expectCountChange(fn () => $this->processingQueueCount(), 0);

        $this->actAsScopedUser($scoreToken->user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $scoreToken->beatmap->getKey(),
                'token' => $scoreToken->getKey(),
            ]),
            [
                'accuracy' => 1,
                'max_combo' => 10,
                'passed' => true,
                'rank' => 'A',
                'statistics' => ['Good' => 1],
                'total_score' => 10,
            ]
        )->assertStatus(200);

        $this->assertSame($score->getKey(), $scoreToken->fresh()->score_id);
    }

    public function testStoreMissingData()
    {
        $scoreToken = ScoreToken::factory()->create();

        $this->expectCountChange(fn () => Score::count(), 0);

        $this->actAsScopedUser($scoreToken->user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $scoreToken->beatmap->getKey(),
                'token' => $scoreToken->getKey(),
            ]),
            [
                'rank' => 'A',
            ]
        )->assertStatus(422);
    }

    public function testStoreWrongUser()
    {
        $otherUser = User::factory()->create();
        $scoreToken = ScoreToken::factory()->create();
        $this->expectCountChange(fn () => Score::count(), 0);

        $this->actAsScopedUser($otherUser, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $scoreToken->beatmap->getKey(),
                'token' => $scoreToken->getKey(),
            ]),
            [
                'accuracy' => 1,
                'max_combo' => 10,
                'passed' => true,
                'rank' => 'A',
                'statistics' => ['Good' => 1],
                'total_score' => 10,
            ]
        )->assertStatus(404);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        static::createApp();
        LaravelRedis::del($GLOBALS['cfg']['osu']['scores']['processing_queue']);
    }

    private function processingQueueCount(): int
    {
        return LaravelRedis::llen($GLOBALS['cfg']['osu']['scores']['processing_queue']);
    }
}
