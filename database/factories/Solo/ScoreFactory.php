<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Solo;

use App\Models\Beatmap;
use App\Models\Solo\Score;
use App\Models\User;
use Database\Factories\Factory;

class ScoreFactory extends Factory
{
    protected $model = Score::class;

    public function definition(): array
    {
        return [
            'beatmap_id' => Beatmap::factory()->ranked(),
            'user_id' => User::factory(),

            // depends on beatmap_id
            'ruleset_id' => fn (array $attr) => Beatmap::find($attr['beatmap_id'])->playmode,

            // depends on all other attributes
            'data' => fn (array $attr): array => $this->makeData()($attr),
        ];
    }

    public function withData(array ...$overrides): static
    {
        return $this->state([
            'data' => $this->makeData(array_merge(...$overrides)),
        ]);
    }

    private function makeData(?array $overrides = null): callable
    {
        return fn (array $attr): array => array_map(
            fn ($value) => is_callable($value) ? $value($attr) : $value,
            array_merge([
                'accuracy' => fn (): float => $this->faker->randomFloat(1, 0, 1),
                'beatmap_id' => $attr['beatmap_id'],
                'ended_at' => fn (): string => json_time(now()),
                'max_combo' => fn (): int => rand(1, Beatmap::find($attr['beatmap_id'])->countNormal),
                'mods' => [],
                'passed' => true,
                'rank' => fn (): string => array_rand_val(['A', 'S', 'B', 'SH', 'XH', 'X']),
                'ruleset_id' => $attr['ruleset_id'],
                'started_at' => fn (): string => json_time(now()->subSeconds(600)),
                'total_score' => fn (): int => $this->faker->randomNumber(7),
                'user_id' => $attr['user_id'],
            ], $overrides ?? []),
        );
    }
}
