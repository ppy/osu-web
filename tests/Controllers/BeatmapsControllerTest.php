<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Tests\TestCase;

class BeatmapsControllerTest extends TestCase
{
    private $user;
    private $beatmap;

    public function testInvalidMode()
    {
        $this->json('GET', route('beatmaps.scores', $this->beatmap), [
            'mode' => 'nope',
        ])->assertStatus(404);
    }

    /**
     * Checks whether HTTP 403 is thrown when a logged out
     * user tries to access the non-general (country or friend ranking)
     * scoreboards.
     */
    public function testNonGeneralScoreboardLoggedOut()
    {
        $this->json('GET', route('beatmaps.scores', $this->beatmap), [
            'type' => 'country',
        ])->assertStatus(422)
        ->assertJson(['error' => trans('errors.supporter_only')]);
    }

    /**
     * Checks whether an error is thrown when an user without supporter
     * tries to access supporter-only scoreboards.
     */
    public function testNonGeneralScoreboardSupporter()
    {
        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap), [
                'type' => 'country',
            ])->assertStatus(422)
            ->assertJson(['error' => trans('errors.supporter_only')]);

        $this->user->osu_subscriber = true;
        $this->user->save();

        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap), [
                'type' => 'country',
            ])->assertStatus(200);
    }

    public function testUpdateOwner(): void
    {
        $otherUser = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertSuccessful();

        $this->assertSame($otherUser->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount + 1, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerInvalidState(): void
    {
        $otherUser = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['qualified'],
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerInvalidUser(): void
    {
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => User::max('user_id') + 1],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerNotOwner(): void
    {
        $otherUser = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create(['user_id' => $this->user->getKey()]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($otherUser)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    public function testUpdateOwnerSameOwner(): void
    {
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user->getKey(),
        ]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $beatmapsetEventCount = BeatmapsetEvent::count();

        $this->actingAsVerified($this->user)
            ->json('PUT', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => $this->user->getKey()],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
        $this->assertSame($beatmapsetEventCount, BeatmapsetEvent::count());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->beatmap = factory(Beatmap::class)->states('approved')->create();
    }
}
