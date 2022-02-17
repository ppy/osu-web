<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\PollOption;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use Database\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        return [
            'forum_id' => Forum::factory(),
            'topic_time' => fn () => $this->faker->dateTimeBetween('-5 years'),
            'topic_title' => fn () => $this->faker->catchPhrase(),
        ];
    }

    public function poll(bool $createPollOptions = true): static
    {
        $factory = $this->state([
            'poll_hide_results' => fn () => $this->faker->boolean(),
            'poll_length' => fn () => $this->faker->randomElement([
                // between 1 and 7 days, or infinite length
                $this->faker->numberBetween(86400, 604800),
                0,
            ]),
            'poll_max_options' => 1,
            'poll_start' => fn (array $attr) => $attr['topic_time'],
            'poll_title' => fn () => $this->faker->sentence(),
            'poll_vote_change' => fn () => $this->faker->boolean(),
        ]);

        if (!$createPollOptions) {
            return $factory;
        }

        $optionCount = $this->faker->numberBetween(2, 10);

        return $factory
            ->state(['poll_max_options' => fn () => $this->faker->numberBetween(1, $optionCount)])
            ->has(
                PollOption::factory()
                    ->count($optionCount)
                    ->sequence(fn (Sequence $sequence) => [
                        'poll_option_id' => $sequence->index,
                    ]),
            );
    }

    public function withPost(): static
    {
        return $this
            ->has(
                Post::factory()
                    ->state(function (array $_attr, Topic $topic) {
                        $attributes = ['post_time' => $topic->topic_time];

                        if ($topic->topic_poster !== null) {
                            $attributes['poster_id'] = $topic->topic_poster;
                        }

                        return $attributes;
                    }),
            )
            ->afterCreating(fn (Topic $topic) => $topic->refreshCache());
    }
}
