<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Forum\PollOption;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\LovedPoll;
use App\Models\User;
use Database\Factories\Forum\TopicFactory;

class LovedPollFactory extends Factory
{
    protected $model = LovedPoll::class;

    public function definition(): array
    {
        return [
            'beatmapset_id' => Beatmapset::factory()->has(Beatmap::factory()),
            'description_author_id' => User::factory(),
            'pass_threshold' => fn () => $this->faker->randomFloat(2, 0, 1),
            'topic_id' => fn () => $this->topicFactory(),

            // Depends on beatmapset_id
            'excluded_beatmap_ids' => fn (array $attr) => [Beatmapset::findOrFail($attr['beatmapset_id'])->beatmaps()->firstOrFail()->getKey()],
            'ruleset_id' => fn (array $attr) => Beatmapset::findOrFail($attr['beatmapset_id'])->playmodes()->firstOrFail(),
        ];
    }

    private function topicFactory(): TopicFactory
    {
        return Topic::factory()
            ->state([
                'poll_hide_results' => true,
                'poll_length' => 864000, // 10 days
                'poll_max_options' => 1,
                'poll_start' => fn (array $attr) => $attr['topic_time'],
                'poll_title' => 'Should this map be Loved?',
                'poll_vote_change' => true,
            ])
            ->has(
                PollOption::factory()
                    ->state(['poll_option_id' => 0, 'poll_option_text' => 'Yes']),
            )
            ->has(
                PollOption::factory()
                    ->state(['poll_option_id' => 1, 'poll_option_text' => 'No']),
            )
            ->has(
                Post::factory()
                    ->state(fn (array $_attr, Topic $topic) => [
                        'post_text' => "[b]Captain's description:[/b]\n{$this->faker->paragraph()}",
                        'post_time' => $topic->topic_time,
                    ]),
            )
            ->afterCreating(fn (Topic $topic) => $topic->refresh());
    }
}
