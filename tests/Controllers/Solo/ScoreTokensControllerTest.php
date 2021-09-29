<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Solo;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Solo\ScoreToken;
use App\Models\User;
use Tests\TestCase;

class ScoreTokensControllerTest extends TestCase
{
    public function testStore()
    {
        $user = factory(User::class)->create();
        $beatmap = factory(Beatmap::class)->states('ranked')->create();
        $hash = md5('testversion');
        Build::factory()->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.score-tokens.store', [
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
        Build::factory()->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.score-tokens.store', [
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
        Build::factory()->create(['hash' => hex2bin($hash), 'allow_ranking' => true]);
        $initialScoreTokenCount = ScoreToken::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.score-tokens.store', [
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
        Build::factory()->create(['hash' => hex2bin(md5('validversion')), 'allow_ranking' => true]);

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.beatmaps.solo.score-tokens.store', [
            'beatmap' => $beatmap->getKey(),
            'ruleset_id' => $beatmap->playmode,
        ]), [
            'version_hash' => md5('invalidversion'),
        ])->assertStatus(422);

        $this->assertSame($initialScoreTokenCount, ScoreToken::count());
    }
}
