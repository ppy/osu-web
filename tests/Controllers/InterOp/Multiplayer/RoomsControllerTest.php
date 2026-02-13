<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp\Multiplayer;

use App\Models\Beatmap;
use App\Models\Chat\UserChannel;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class RoomsControllerTest extends TestCase
{
    private static function startRoomParams(): array
    {
        $beatmap = Beatmap::factory()->create();

        return [
            'ends_at' => CarbonImmutable::now()->addHours(1),
            'name' => 'test room',
            'type' => Room::REALTIME_DEFAULT_TYPE,
            'playlist' => [[
                'beatmap_id' => $beatmap->getKey(),
                'ruleset_id' => $beatmap->playmode,
            ]],
        ];
    }

    public function testJoin(): void
    {
        $room = (new Room())->startGame(User::factory()->create(), static::startRoomParams());
        $user = User::factory()->create();

        $this->expectCountChange(fn () => UserChannel::count(), 1);

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.join', [
                'room' => $room->getKey(),
                'user' => $user->getKey(),
            ]),
            fn ($url) => $this->put($url),
        )->assertSuccessful();
    }

    public function testJoinWithPassword(): void
    {
        $room = (new Room())->startGame(User::factory()->create(), [
            ...static::startRoomParams(),
            'password' => 'hunter2',
        ]);
        $user = User::factory()->create();

        $this->expectCountChange(fn () => UserChannel::count(), 1);

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.join', [
                'room' => $room->getKey(),
                'user' => $user->getKey(),
            ]),
            fn ($url) => $this->put($url, ['password' => 'hunter2']),
        )->assertSuccessful();
    }

    public function testJoinWithPasswordInvalid(): void
    {
        $room = (new Room())->startGame(User::factory()->create(), [
            ...static::startRoomParams(),
            'password' => 'hunter2',
        ]);
        $user = User::factory()->create();

        $this->expectCountChange(fn () => UserChannel::count(), 0);

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.join', [
                'room' => $room->getKey(),
                'user' => $user->getKey(),
            ]),
            fn ($url) => $this->put($url, ['password' => '*******']),
        )->assertStatus(403);
    }

    public function testStore(): void
    {
        $beatmap = Beatmap::factory()->create();
        $params = [
            ...static::startRoomParams(),
            'user_id' => User::factory()->create()->getKey(),
        ];

        $this->expectCountChange(fn () => Room::count(), 1);

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.store'),
            fn ($url) => $this->post($url, $params),
        )->assertSuccessful();
    }

    public function testUserCanOnlyStoreOneRoomIfNotTournamentMode(): void
    {
        $params = [
            ...static::startRoomParams(),
            'user_id' => User::factory()->create()->getKey(),
        ];

        $this->expectCountChange(fn () => Room::count(), 1);

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.store'),
            fn ($url) => $this->post($url, $params),
        )->assertSuccessful();

        $this->withInterOpHeader(
            route('interop.multiplayer.rooms.store'),
            fn ($url) => $this->post($url, $params),
        )->assertStatus(422);
    }

    public function testUserCanStoreMoreRoomsIfTournamentMode(): void
    {
        $user = User::factory()->create();
        $params = [
            ...static::startRoomParams(),
            'user_id' => $user->getKey(),
            'tournament_mode' => true,
        ];

        $maxTournamentRooms = $user->maxTournamentRooms();

        $this->expectCountChange(fn () => Room::count(), $maxTournamentRooms);

        for ($i = 0; $i < $maxTournamentRooms + 1; $i++) {
            $response = $this->withInterOpHeader(
                route('interop.multiplayer.rooms.store'),
                fn($url) => $this->post($url, $params),
            );

            if ($i < $maxTournamentRooms) {
                $response->assertSuccessful();
            } else {
                $response->assertStatus(422);
            }
        }
    }

    public function testUserCanStoreEvenMoreRoomsIfBot(): void
    {
        $normalUser = User::factory()->create();
        $botUser = User::factory()->withGroup('bot')->create();
        $params = [
            ...static::startRoomParams(),
            'user_id' => $botUser->getKey(),
            'tournament_mode' => true,
        ];

        $countRoomsToCreate = $normalUser->maxTournamentRooms() + 2;

        $this->expectCountChange(fn () => Room::count(), $countRoomsToCreate);

        for ($i = 0; $i < $countRoomsToCreate; $i++) {
            $response = $this->withInterOpHeader(
                route('interop.multiplayer.rooms.store'),
                fn($url) => $this->post($url, $params),
            );

            $response->assertSuccessful();
        }
    }
}
