<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Beatmap;
use App\Models\Build;
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
        $hash = md5('testversion');
        factory(Build::class)->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store-token', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => $hash,
        ])->assertSuccessful();

        $this->assertSame($initialScoreTokenCount + 1, ScoreToken::count());
    }

    public function testStorePending()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('wip')->create();
        $hash = md5('testversion');
        factory(Build::class)->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store-token', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => $hash,
        ])->assertStatus(404);

        $this->assertSame($initialScoreTokenCount, ScoreToken::count());
    }

    public function testStoreMissingRulesetId()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $hash = md5('testversion');
        factory(Build::class)->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store-token', [
            'beatmap' => $beatmap->getKey(),
        ]), [
            'version_hash' => $hash,
        ])->assertStatus(422);

        $this->assertSame($initialScoreTokenCount, ScoreToken::count());
    }

    public function testStoreInvalidHash()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $initialScoreTokenCount = ScoreToken::count();
        factory(Build::class)->create(['hash' => hex2bin(md5('validversion')), 'allow_ranking' => true]);

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store-token', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => md5('invalidversion'),
        ])->assertStatus(422);

        $this->assertSame($initialScoreTokenCount, ScoreToken::count());
    }

    public function testUpdate()
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

    public function testUpdateMissingData()
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

    public function testUpdateWrongUser()
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
