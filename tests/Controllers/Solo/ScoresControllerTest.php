<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Beatmap;
use App\Models\Score as LegacyScore;
use App\Models\Solo\Score;
use App\Models\Solo\ScoreToken;
use App\Models\User;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testStore()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $scoreToken = ScoreToken::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
        ]);
        $legacyScoreClass = LegacyScore\Model::getClass($beatmap->playmode);

        $initialScoreCount = Score::count();
        $initialScoreTokenCount = ScoreToken::count();
        $initialLegacyScoreCount = $legacyScoreClass::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $beatmap->getKey(),
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
        )->assertSuccessful();

        $this->assertSame($initialLegacyScoreCount + 1, $legacyScoreClass::count());
        $this->assertSame($initialScoreCount + 1, Score::count());
        $this->assertNotNull($scoreToken->fresh()->score);
    }

    public function testStoreCompleted()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        // TODO: create factory
        $score = Score::createFromJsonOrExplode([
            'accuracy' => 1,
            'beatmap_id' => $beatmap->getKey(),
            'ended_at' => now(),
            'max_combo' => 10,
            'mods' => [],
            'passed' => true,
            'rank' => 'A',
            'ruleset_id' => $beatmap->playmode,
            'statistics' => ['Good' => 1],
            'total_score' => 10,
            'user_id' => $user->getKey(),
        ]);
        $scoreToken = ScoreToken::create([
            'beatmap_id' => $score->beatmap_id,
            'ruleset_id' => $score->ruleset_id,
            'score_id' => $score->getKey(),
            'user_id' => $score->user_id,
        ]);

        $initialScoreCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $beatmap->getKey(),
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
        $this->assertSame($initialScoreCount, Score::count());
    }

    public function testStoreMissingData()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $scoreToken = ScoreToken::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
        ]);

        $initialScoreCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $beatmap->getKey(),
                'token' => $scoreToken->getKey(),
            ]),
            [
                'rank' => 'A',
            ]
        )->assertStatus(422);

        $this->assertSame($initialScoreCount, Score::count());
    }

    public function testStoreWrongUser()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $scoreToken = ScoreToken::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
        ]);
        $initialScoreCount = Score::count();

        $this->actAsScopedUser($otherUser, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.store', [
                'beatmap' => $beatmap->getKey(),
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

        $this->assertSame($initialScoreCount, Score::count());
    }
}
