<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Beatmapset;

use App\Exceptions\AuthorizationException;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapOwnerChange;
use App\Libraries\Beatmapset\ChangeBeatmapOwners;
use App\Models\Beatmap;
use App\Models\BeatmapOwner;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\DeletedUser;
use App\Models\User;
use Arr;
use Bus;
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

    public function testMissingUser(): void
    {
        $moderator = User::factory()->withGroup('nat')->create();
        $otherUser = User::factory()->create();
        $missingUserId = User::max('user_id') + 1;
        $userIds = [$missingUserId, $otherUser->getKey()];

        $beatmap = Beatmap::factory()
            ->state(['user_id' => $missingUserId])
            ->has(BeatmapOwner::factory()->state(['user_id' => $missingUserId]))
            ->for(Beatmapset::factory()->pending()->state(['user_id' => $missingUserId]))
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        (new ChangeBeatmapOwners($beatmap, $userIds, $moderator))->handle();

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing($userIds, $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($userIds[0], $beatmap->user_id);

        Bus::assertDispatched(BeatmapOwnerChange::class);
    }

    public function testUpdateOwner(): void
    {
        $users = User::factory()->count(2)->create();
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        (new ChangeBeatmapOwners($beatmap, $users->pluck('user_id')->toArray(), $owner))->handle();

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing($users->pluck('user_id'), $beatmap->getOwners()->pluck('user_id'));
        $this->assertSame($users[0]->getKey(), $beatmap->user_id);

        Bus::assertDispatched(BeatmapOwnerChange::class);
    }

    public function testUpdateOwnerExistingRestrictedUser(): void
    {
        $source = User::factory()->withGroup('gmt')->create();
        $owner = User::factory()->restricted()->create();
        $users = [User::factory()->create(), $owner];
        $ownerId = $owner->getKey();

        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->assertTrue($owner->is($beatmap->getOwners()->find($ownerId)));

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 1);

        (new ChangeBeatmapOwners($beatmap, Arr::pluck($users, 'user_id'), $source))->handle();

        $beatmap = $beatmap->fresh();
        $newOwners = $beatmap->getOwners();
        $this->assertCount(count($users), $newOwners);
        $this->assertEqualsCanonicalizing(Arr::pluck($users, 'user_id'), $newOwners->pluck('user_id')->toArray());

        Bus::assertDispatched(BeatmapOwnerChange::class);
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
            fn () => (new ChangeBeatmapOwners($beatmap, [$user->getKey()], $owner))->handle(),
            AuthorizationException::class
        );

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing([$owner->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($owner->getKey(), $beatmap->user_id);

        Bus::assertNotDispatched(BeatmapOwnerChange::class);
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
            fn () => (new ChangeBeatmapOwners($beatmap, [User::max('user_id') + 1], $owner))->handle(),
            InvariantException::class
        );

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing([$owner->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($owner->getKey(), $beatmap->user_id);

        Bus::assertNotDispatched(BeatmapOwnerChange::class);
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
            fn () => (new ChangeBeatmapOwners($beatmap, [$user->getKey()], $moderator))->handle(),
            $ok ? null : AuthorizationException::class,
        );

        $beatmap = $beatmap->fresh();
        $expectedUser = $ok ? $user : $owner;
        $this->assertEqualsCanonicalizing([$expectedUser->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($expectedUser->getKey(), $beatmap->user_id);

        if ($ok) {
            Bus::assertDispatched(BeatmapOwnerChange::class);
        } else {
            Bus::assertNotDispatched(BeatmapOwnerChange::class);
        }
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

        (new ChangeBeatmapOwners($beatmap, [$user->getKey()], $moderator))->handle();

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing([$user->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($user->getKey(), $beatmap->user_id);
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
            fn () => (new ChangeBeatmapOwners($beatmap, [$user->getKey()], $user))->handle(),
            AuthorizationException::class,
        );

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing([$owner->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($owner->getKey(), $beatmap->user_id);

        Bus::assertNotDispatched(BeatmapOwnerChange::class);
    }

    public function testUpdateOwnerSameOwner(): void
    {
        $owner = User::factory()->create();
        $beatmap = Beatmap::factory()
            ->for(Beatmapset::factory()->pending()->owner($owner))
            ->owner($owner)
            ->create();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);
        (new ChangeBeatmapOwners($beatmap, [$owner->getKey()], $owner))->handle();

        $beatmap = $beatmap->fresh();
        $this->assertEqualsCanonicalizing([$owner->getKey()], $beatmap->getOwners()->pluck('user_id')->toArray());
        $this->assertSame($owner->getKey(), $beatmap->user_id);

        Bus::assertNotDispatched(BeatmapOwnerChange::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Bus::fake([BeatmapOwnerChange::class]);
    }
}
