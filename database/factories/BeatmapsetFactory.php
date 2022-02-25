<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;

class BeatmapsetFactory extends Factory
{
    protected $model = Beatmapset::class;

    public function definition(): array
    {
        return [
            'artist' => fn () => $this->faker->name(),
            'title' => fn () => substr($this->faker->sentence(rand(0, 5)), 0, 80),
            'discussion_enabled' => true,
            'source' => fn () => $this->faker->domainWord(),
            'tags' => fn () => $this->faker->domainWord(),
            'bpm' => rand(100, 200),
            'approved' => rand(0, 1),
            'play_count' => rand(0, 50000),
            'favourite_count' => rand(0, 500),
            'genre_id' => Genre::factory(),
            'language_id' => Language::factory(),
            'submit_date' => fn () => $this->faker->dateTime(),
            'thread_id' => 0,
            'user_id' => 0, // follow db default if no user specified; this is for other factories that depend on user_id.
            'offset' => $faker->randomDigit(),

            // depends on approved
            'approved_date' => fn (array $attr) => $attr['approved'] > 0 ? now() : null,

            'creator' => fn (array $attr) => User::find($attr['user_id'])?->username ?? $this->faker->userName(),

            // depends on artist and title
            'displaytitle' => fn (array $attr) => "{$attr['artist']}|{$attr['title']}",
        ];
    }

    public function deleted()
    {
        return $this->state(['deleted_at' => now()]);
    }

    public function inactive()
    {
        return $this->state(['active' => 0]);
    }

    public function noDiscussion()
    {
        return $this->state(['discussion_enabled' => false]);
    }

    public function owner(?User $user = null)
    {
        return $this->state(['user_id' => $user ?? User::factory()]);
    }

    public function pending()
    {
        return $this->state([
            'approved' => Beatmapset::STATES['pending'],
            'approved_date' => null,
            'queued_at' => null,
        ]);
    }

    public function qualified()
    {
        $approvedAt = now();

        return $this->state([
            'approved' => Beatmapset::STATES['qualified'],
            'approved_date' => $approvedAt,
            'queued_at' => $approvedAt,
        ]);
    }

    public function withDiscussion()
    {
        return $this
            ->has(Beatmap::factory()->state(fn (array $attr, Beatmapset $set) => ['user_id' => $set->user_id]))
            ->has(BeatmapDiscussion::factory()->general()->state(fn (array $attr, Beatmapset $set) => [
                'user_id' => $set->user_id,
            ]));
    }
}
