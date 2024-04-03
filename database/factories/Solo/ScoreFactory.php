<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Solo;

use App\Enums\ScoreRank;
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
            'accuracy' => fn (): float => $this->faker->randomFloat(1, 0, 1),
            'beatmap_id' => Beatmap::factory()->ranked(),
            'ended_at' => new \DateTime(),
            'pp' => fn (): float => $this->faker->randomFloat(4, 0, 1000),
            'rank' => fn () => array_rand_val(ScoreRank::cases())->value,
            'total_score' => fn (): int => $this->faker->randomNumber(7),
            'user_id' => User::factory(),

            // depends on beatmap_id
            'ruleset_id' => fn (array $attr) => Beatmap::find($attr['beatmap_id'])->playmode,

            // depends on all other attributes
            'data' => fn (array $attr): array => $this->makeData()($attr),

            'legacy_total_score' => fn (array $attr): int => isset($attr['legacy_score_id']) ? $attr['total_score'] : 0,
        ];
    }

    public function withData(array ...$overrides): static
    {
        return $this->state([
            'data' => $this->makeData(array_merge(...$overrides)),
        ]);
    }

    public function withReplay(): static
    {
        return $this
            ->state(['has_replay' => true])
            ->afterCreating(function ($score) {
                Score::replayFileStorage()->put($score->getKey(), 'placeholder replay file');
            });
    }

    private function makeData(?array $overrides = null): callable
    {
        return fn (array $attr): array => array_map(
            fn ($value) => is_callable($value) ? $value($attr) : $value,
            [
                'statistics' => ['great' => 1],
                'mods' => [],
                ...($overrides ?? []),
            ],
        );
    }
}
