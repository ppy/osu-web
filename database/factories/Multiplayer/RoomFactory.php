<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Multiplayer;

use App\Models\Chat\Channel;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function configure(): static
    {
        return $this->afterCreating(function (Room $room) {
            $channel = Channel::createMultiplayer($room);

            $room->update(['channel_id' => $channel->getKey()]);
        });
    }

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fn() => $this->faker->realText(20),
            'starts_at' => fn() => Carbon::now()->subHours(1),
            'ends_at' => fn() => Carbon::now()->addHours(1),
        ];
    }

    public function ended(): static
    {
        return $this->state(['ends_at' => Carbon::now()->subMinutes(1)]);
    }
}
