<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Build;
use App\Models\ScoreToken;
use App\Models\Solo\Score;
use App\Models\User;
use LaravelRedis;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testStore()
    {
        $build = Build::factory()->create(['allow_ranking' => true]);
        $scoreToken = ScoreToken::factory()->create(['build_id' => $build]);

        $this->expectCountChange(fn () => Score::count(), 1);
        $this->expectCountChange(fn () => $this->processingQueueCount(), 1);
        $this->expectCountChange(
            fn () => \LaravelRedis::llen($GLOBALS['cfg']['osu']['client']['token_queue']),
            1,
        );

        $this->withHeaders(['x-token' => static::createClientToken($build)]);
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

    public function testStoreUpdatedBeatmap()
    {
        $build = Build::factory()->create(['allow_ranking' => true]);
        $scoreToken = ScoreToken::factory()->create(['build_id' => $build]);
        $scoreToken->beatmap->beatmapset->update(['approved_date' => $scoreToken->created_at->addMinutes(5)]);

        $this->expectCountChange(fn () => Score::count(), 0);
        $this->expectCountChange(fn () => $this->processingQueueCount(), 0);
        $this->expectCountChange(
            fn () => \LaravelRedis::llen($GLOBALS['cfg']['osu']['client']['token_queue']),
            0,
        );

        $this->withHeaders(['x-token' => static::createClientToken($build)]);
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
        )->assertStatus(422);

        $score = $scoreToken->fresh()->score;
        $this->assertNull($score);
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

    public function testStoreInvalidModCombination()
    {
        $scoreToken = ScoreToken::factory()->create();
        $this->expectCountChange(fn () => Score::count(), 0);

        $this->actAsScopedUser($scoreToken->user);

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
                    ['acronym' => 'HT'],
                ],
                'passed' => true,
                'rank' => 'A',
                'statistics' => ['Good' => 1],
                'total_score' => 10,
            ]
        )->assertStatus(422);
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
