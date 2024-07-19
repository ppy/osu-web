<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Multiplayer;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Solo\Score;
use App\Models\User;
use Database\Factories\Factory;

class ScoreLinkFactory extends Factory
{
    protected $model = ScoreLink::class;

    public function completed(?array $scoreAttr = [], ?array $scoreDataAttr = []): static
    {
        return $this->state([
            'score_id' => fn (array $attr) => Score::factory([
                'beatmap_id' => PlaylistItem::find($attr['playlist_item_id'])->beatmap_id,
                'user_id' => $attr['user_id'],
                ...$scoreAttr,
            ])->withData($scoreDataAttr),
        ]);
    }

    public function definition(): array
    {
        return [
            'playlist_item_id' => PlaylistItem::factory(),
            'user_id' => User::factory(),

            'score_id' => fn (array $attr) => Score::factory([
                'beatmap_id' => PlaylistItem::find($attr['playlist_item_id'])->beatmap_id,
                'user_id' => $attr['user_id'],
            ]),
        ];
    }

    public function failed(): static
    {
        return $this->completed(['passed' => false]);
    }

    public function passed(): static
    {
        return $this->completed(['passed' => true]);
    }
}
