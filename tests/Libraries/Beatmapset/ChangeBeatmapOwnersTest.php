<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\BeatmapsetDiscussion;

use App\Exceptions\AuthorizationException;
use App\Exceptions\InvariantException;
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

        $this->beatmap->setOwner([$otherUser->getKey()], $this->user);

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
        $this->expectException(AuthorizationException::class);

        $this->beatmap->setOwner([$otherUser->getKey()], $this->user);

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
        $this->expectException(InvariantException::class);

        $this->beatmap->setOwner([user::max('user_id') + 1], $this->user);

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

        if (!$ok) {
            $this->expectException(AuthorizationException::class);
        }

        $this->beatmap->setOwner([$this->user->getKey()], $moderator);

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

        $this->beatmap->setOwner([$this->user->getKey()], $moderator);

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
        $this->expectException(AuthorizationException::class);

        $this->beatmap->setOwner([$otherUser->getKey()], $otherUser);

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

        $this->beatmap->setOwner([$this->user->getKey()], $this->user);

        $this->assertSame($this->user->getKey(), $this->beatmap->fresh()->user_id);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->beatmap = Beatmap::factory()->qualified()->create();
    }
}
