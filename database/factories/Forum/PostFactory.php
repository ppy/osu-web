<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use Database\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post) {
            $post->topic->refreshCache();
            $post->forum->refreshCache();
        });
    }

    public function definition(): array
    {
        return [
            'post_text' => fn () => $this->faker->paragraph(),
            'post_time' => fn () => $this->faker->dateTimeBetween('-5 years'),
            'poster_id' => User::factory(),
            'topic_id' => Topic::factory(),

            // depends on topic_id
            'forum_id' => fn (array $attr) => Topic::find($attr['topic_id'])->forum_id,

            // depends on poster_id
            'post_username' => fn (array $attr) => User::find($attr['poster_id'])->username,
        ];
    }
}
