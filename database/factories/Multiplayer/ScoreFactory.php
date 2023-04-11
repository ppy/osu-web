<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Score;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\Factory;

class ScoreFactory extends Factory
{
    protected $model = Score::class;

    public function completed(): static
    {
        return $this->state(['ended_at' => Carbon::now()->subMinutes(1)]);
    }

    public function definition(): array
    {
        return [
            'accuracy' => 0.5,
            'playlist_item_id' => PlaylistItem::factory(),
            'pp' => 1,
            'started_at' => fn() => Carbon::now()->subMinutes(5),
            'total_score' => 1,
            'user_id' => User::factory(),

            'beatmap_id' => fn(array $attributes) => PlaylistItem::find($attributes['playlist_item_id'])->beatmap_id,
            'room_id' => fn(array $attributes) => PlaylistItem::find($attributes['playlist_item_id'])->room_id,
        ];
    }

    public function failed(): static
    {
        return $this->completed()->state(['passed' => false]);
    }

    public function passed(): static
    {
        return $this->completed()->state(['passed' => true]);
    }

    public function scoreless(): static
    {
        return $this->state(['total_score' => 0]);
    }
}
