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
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        $beatmap->setOwner([$user->getKey()], $owner);

        $this->assertSame($user->getKey(), $beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerInvalidState(): void
    {
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->qualified()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);
        $this->expectExceptionCallable(
            fn () => $beatmap->setOwner([$user->getKey()], $owner),
            AuthorizationException::class
        );

        $this->assertSame($owner->getKey(), $beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerInvalidUser(): void
    {
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);
        $this->expectExceptionCallable(
            fn () => $beatmap->setOwner([User::max('user_id') + 1], $owner),
            InvariantException::class
        );

        $this->assertSame($owner->getKey(), $beatmap->fresh()->user_id);
    }

    /**
     * @dataProvider dataProviderForTestUpdateOwnerLoved
     */
    public function testUpdateOwnerLoved(int $approved, bool $ok): void
    {
        $moderator = User::factory()->withGroup('loved')->create();
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->state([
                'approved' => $approved,
                'approved_date' => now(),
            ])->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $ok ? 1 : 0);

        $this->expectExceptionCallable(
            fn () => $beatmap->setOwner([$user->getKey()], $moderator),
            $ok ? null : AuthorizationException::class,
        );

        $this->assertSame($ok ? $user->getKey() : $owner->getKey(), $beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerModerator(): void
    {
        $moderator = User::factory()->withGroup('nat')->create();
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->state([
                'approved' => Beatmapset::STATES['ranked'],
                'approved_date' => now(),
            ])->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        $beatmap->setOwner([$user->getKey()], $moderator);

        $this->assertSame($user->getKey(), $beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerNotOwner(): void
    {
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->state([
                'approved' => Beatmapset::STATES['ranked'],
                'approved_date' => now(),
            ])->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);
        $this->expectExceptionCallable(
            fn () => $beatmap->setOwner([$user->getKey()], $user),
            AuthorizationException::class,
        );

        $this->assertSame($owner->getKey(), $beatmap->fresh()->user_id);
    }

    public function testUpdateOwnerSameOwner(): void
    {
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);
        $beatmap->setOwner([$owner->getKey()], $owner);

        $this->assertSame($owner->getKey(), $beatmap->user_id);
    }
}
