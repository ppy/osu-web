<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Score as LegacyScore;
use App\Models\Solo\Score;
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
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => $hash,
        ])->assertSuccessful();

        $this->assertSame($initialScoresCount + 1, Score::count());
    }

    public function testStorePending()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('pending')->create();
        $hash = md5('testversion');
        factory(Build::class)->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => $hash,
        ])->assertStatus(404);

        $this->assertSame($initialScoresCount, Score::count());
    }

    public function testStoreMissingRulesetId()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $hash = md5('testversion');
        factory(Build::class)->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store', [
            'beatmap' => $beatmap->getKey(),
        ]), [
            'version_hash' => $hash,
        ])->assertStatus(422);

        $this->assertSame($initialScoresCount, Score::count());
    }

    public function testStoreInvalidHash()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $initialScoresCount = Score::count();
        factory(Build::class)->create(['hash' => hex2bin(md5('validversion')), 'allow_ranking' => true]);

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.scores.store', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => md5('invalidversion'),
        ])->assertStatus(422);

        $this->assertSame($initialScoresCount, Score::count());
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $score = Score::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
            'updated_at' => now()->subHour(1), // prevent same time if run too fast
        ]);
        $legacyScoreClass = LegacyScore\Model::getClass($beatmap->playmode);

        $initialScoreUpdate = json_time($score->updated_at);
        $initialLegacyScoreCount = $legacyScoreClass::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.update', [
                'beatmap' => $beatmap->getKey(),
                'score' => $score->getKey(),
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
        $this->assertNotSame($initialScoreUpdate, json_time($score->fresh()->updated_at));
    }

    public function testUpdateMissingData()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $score = Score::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
            'updated_at' => now()->subHour(1), // prevent same time if run too fast
        ]);
        $initialScoreUpdate = json_time($score->updated_at);

        $this->actAsScopedUser($user, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.update', [
                'beatmap' => $beatmap->getKey(),
                'score' => $score->getKey(),
            ]),
            [
                'rank' => 'A',
            ]
        )->assertStatus(422);

        $this->assertSame($initialScoreUpdate, json_time($score->fresh()->updated_at));
    }

    public function testUpdateWrongUser()
    {
        $user = factory(User::class)->create();
        $otherUser = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $score = Score::create([
            'beatmap_id' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
            'user_id' => $user->getKey(),
            'updated_at' => now()->subHour(1), // prevent same time if run too fast
        ]);
        $initialScoreUpdate = json_time($score->updated_at);

        $this->actAsScopedUser($otherUser, ['*']);

        $this->json(
            'PUT',
            route('api.beatmaps.solo.scores.update', [
                'beatmap' => $beatmap->getKey(),
                'score' => $score->getKey(),
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

        $this->assertSame($initialScoreUpdate, json_time($score->fresh()->updated_at));
    }
}
