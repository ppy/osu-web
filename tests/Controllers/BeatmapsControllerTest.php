<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BeatmapsControllerTest extends TestCase
{
    private $user;
    private $beatmap;

    public function testIndexForApi(): void
    {
        $beatmap = Beatmap::factory()->create();
        $beatmapB = Beatmap::factory()->create();
        $beatmapC = Beatmap::factory()->create();
        $beatmapC->beatmapset->update(['active' => false]);

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.index', ['ids' => [$beatmap->getKey(), $beatmapB->getKey(), $beatmapC->getKey()]]))
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('beatmaps.0.id', $beatmap->getKey())
                    ->where('beatmaps.1.id', $beatmapB->getKey())
                    ->missing('beatmaps.2')
                    ->etc());
    }

    public function testIndexForApiMissingParameter(): void
    {
        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.index'))
            ->assertSuccessful();
    }

    public function testInvalidMode()
    {
        $this->json('GET', route('beatmaps.scores', $this->beatmap), [
            'mode' => 'nope',
        ])->assertStatus(404);
    }

    /**
     * @dataProvider dataProviderForTestLookupForApi
     */
    public function testLookupForApi(string $key, callable $valueFn): void
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.lookup', [$key => $valueFn($beatmap)]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
    }

    /**
     * Make sure the lookup stops when finding beatmap from one of the parameters
     */
    public function testLookupMultipleParamsForApi(): void
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.lookup', [
                'checksum' => '',
                'id' => (string) $beatmap->getKey(),
                'filename' => '',
            ]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
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
        ->assertJson(['error' => osu_trans('errors.supporter_only')]);
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
            ->assertJson(['error' => osu_trans('errors.supporter_only')]);

        $this->user->osu_subscriber = true;
        $this->user->save();

        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', $this->beatmap), [
                'type' => 'country',
            ])->assertStatus(200);
    }

    public function testShowForApi()
    {
        $beatmap = Beatmap::factory()->create();

        $this->actAsScopedUser(User::factory()->create(), ['*']);

        $this
            ->get(route('api.beatmaps.show', ['beatmap' => $beatmap->getKey()]))
            ->assertSuccessful()
            ->assertJsonPath('id', $beatmap->getKey());
    }

    public function testUpdateOwner(): void
    {
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
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
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['qualified'],
            'user_id' => $this->user,
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
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
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
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create(['user_id' => $this->user]);
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
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $this->user,
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

    public function dataProviderForTestLookupForApi(): array
    {
        return [
            'checksum' => ['checksum', fn (Beatmap $b) => $b->checksum],
            'filename' => ['filename', fn (Beatmap $b) => $b->filename],
            'id' => ['id', fn (Beatmap $b) => $b->getKey()],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->beatmap = Beatmap::factory()->qualified()->create();
    }
}
