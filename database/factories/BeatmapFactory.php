<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\BeatmapOwner;
use App\Models\Beatmapset;
use App\Models\BeatmapTag;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class BeatmapFactory extends Factory
{
    protected $model = Beatmap::class;

    public function convertsToManiaKeys(int $keys): static
    {
        return $this->state([
            'playmode' => Beatmap::MODES['osu'],
            ...match ($keys) {
                4 => [
                    'countNormal' => 2,
                    'countSlider' => 10,
                    'countSpinner' => 0,
                    'diff_overall' => 3,
                    'diff_size' => 4,
                ],
                6 => [
                    'countNormal' => 2,
                    'countSlider' => 10,
                    'countSpinner' => 0,
                    'diff_overall' => 5,
                    'diff_size' => 10,
                ],
                7 => [
                    'countNormal' => 2,
                    'countSlider' => 0,
                    'countSpinner' => 0,
                    'diff_overall' => 1,
                    'diff_size' => 1,
                ],
            },
        ]);
    }

    public function definition(): array
    {
        return [
            'beatmapset_id' => fn () => Beatmapset::factory(),
            'filename' => fn () => $this->faker->sentence(3),
            'last_update' => Carbon::now(),
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

    public function owner(User $user): static
    {
        return $this
            ->state(['user_id' => $user])
            ->has(BeatmapOwner::factory()->state(fn (array $attr, Beatmap $beatmap) => [
                'user_id' => $beatmap->user_id,
            ]));
    }

    public function qualified(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['qualified']]);
    }

    public function ranked(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['ranked']]);
    }

    public function ruleset(string $ruleset): static
    {
        return $this->state(['playmode' => Beatmap::modeInt($ruleset)]);
    }

    public function wip(): static
    {
        return $this->state(['approved' => Beatmapset::STATES['wip']]);
    }

    public function withTag(int|Tag|null $tag = null, ?int $userId = null): static
    {
        return $this->has(BeatmapTag::factory()->state([
            'tag_id' => $tag ?? Tag::factory(),
            'user_id' => $userId ?? User::factory(),
        ]));
    }
}
