<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\BeatmapsetDiscussion;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Tests\TestCase;

class ChangeBeatmapOwnersTest extends TestCase
{
    private Beatmap $beatmap;
    private User $user;

    public static function dataProviderForTestUpdateOwnerLoved(): array
    {
        return [
            [Beatmapset::STATES['graveyard'], true],
            [Beatmapset::STATES['loved'], true],
            [Beatmapset::STATES['ranked'], false],
            [Beatmapset::STATES['wip'], false],
        ];
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

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        $this->actingAsVerified($this->user)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [$otherUser->getKey()],
            ])->assertSuccessful();

        $this->assertSame($otherUser->getKey(), $this->beatmap->fresh()->user_id);
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

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);

        $this->actingAsVerified($this->user)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [$otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
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

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);

        $this->actingAsVerified($this->user)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [User::max('user_id') + 1],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
    }

    /**
     * @dataProvider dataProviderForTestUpdateOwnerLoved
     */
    public function testUpdateOwnerLoved(int $approved, bool $ok): void
    {
        $moderator = User::factory()->withGroup('loved')->create();
        $this->beatmap->beatmapset->update([
            'approved' => $approved,
            'approved_date' => now(),
        ]);

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $ok ? 1 : 0);
        $expectedOwner = $ok ? $this->user->getKey() : $this->beatmap->fresh()->user_id;

        $this->actingAsVerified($moderator)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [$this->user->getKey()],
            ])->assertStatus($ok ? 200 : 403);

        $this->assertSame($expectedOwner, $this->beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerModerator(): void
    {
        $moderator = User::factory()->withGroup('nat')->create();
        $this->beatmap->beatmapset->update([
            'approved' => Beatmapset::STATES['ranked'],
            'approved_date' => now(),
        ]);

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        $this->actingAsVerified($moderator)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [$this->user->getKey()],
            ])->assertSuccessful();

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerNotOwner(): void
    {
        $otherUser = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create(['user_id' => $this->user]);
        $this->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $this->user->getKey(),
        ]);

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);

        $this->actingAsVerified($otherUser)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'user_ids' => [$otherUser->getKey()],
            ])->assertStatus(403);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
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

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);

        $this->actingAsVerified($this->user)
            ->json('POST', route('beatmaps.update-owner', $this->beatmap), [
                'beatmap' => ['user_id' => [$this->user->getKey()]],
            ])->assertStatus(422);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->beatmap = Beatmap::factory()->qualified()->create();
    }
}
