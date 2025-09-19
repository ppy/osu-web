<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Multiplayer\Room;
use App\Models\Season;
use App\Models\SeasonRoom;

class SeasonRoomFactory extends Factory
{
    protected $model = SeasonRoom::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'season_id' => Season::factory(),
        ];
    }
}
