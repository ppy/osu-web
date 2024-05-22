<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Multiplayer;

use App\Models\Beatmap;
use App\Models\Multiplayer\DailyChallengeQueueItem;
use Database\Factories\Factory;

class DailyChallengeQueueItemFactory extends Factory
{
    protected $model = DailyChallengeQueueItem::class;

    public function definition(): array
    {
        return [
            'beatmap_id' => Beatmap::factory(),
            'ruleset_id' => fn(array $attributes) => Beatmap::find($attributes['beatmap_id'])->playmode,
            'allowed_mods' => [],
            'required_mods' => [],
        ];
    }
}
