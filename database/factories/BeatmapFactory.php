<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\Beatmapset;

class BeatmapFactory extends Factory
{
    protected $model = Beatmap::class;

    public function definition(): array
    {
        return [
            'beatmapset_id' => fn () => Beatmapset::factory(),
            'filename' => fn () => $this->faker->sentence(3),
            'checksum' => md5((string) rand()),
            'version' => fn () => $this->faker->domainWord(),
            'total_length' => rand(30, 200),
            'hit_length' => fn (array $attr) => $attr['total_length'] - rand(0, 20),
            'countSpinner' => rand(0, 5),
            'countNormal' => rand(100, 2000),
            'bpm' => rand(100, 200),
            'diff_drain' => rand(0, 10),
            'diff_size' => rand(0, 10),
            'diff_overall' => rand(0, 10),
            'diff_approach' => rand(0, 10),
            'playmode' => array_rand_val(Beatmap::MODES),
            'approved' => array_rand_val(Beatmapset::STATES),
            'difficultyrating' => rand(0, 5000) / 1000,
            'playcount' => rand(0, 50000),

            // depends on countNormal
            'countSlider' => fn (array $attr) => round($attr['countNormal'] / 9),

            // depends on playcount
            'passcount' => fn (array $attr) => round($attr['playcount'] * 0.7),
        ];
    }

    public function deleted(): static
    {
        return $this->state(['deleted_at' => now()]);
    }

    public function deletedBeatmapset(): static
    {
        return $this->state([
            'beatmapset_id' => Beatmapset::factory()->deleted(),
        ]);
    }

    public function inactive(): static
    {
        return $this->state([
            'beatmapset_id' => Beatmapset::factory()->state(['active' => false]),
        ]);
    }

    public function qualified(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['qualified']]);
    }

    public function ranked(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['ranked']]);
    }

    public function wip(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['wip']]);
    }
}
