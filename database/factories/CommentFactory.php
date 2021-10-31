<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Libraries\MorphMap;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'commentable_type' => fn () => $this->faker->randomElement(Comment::COMMENTABLES),
            'created_at' => fn () => $this->faker->dateTime(),
            'message' => fn () => $this->faker->paragraph(),
            'user_id' => User::factory(),

            // depends on commentable_type
            'commentable_id' => fn (array $attr) => MorphMap::getClass($attr['commentable_type'])::factory(),

            // depends on created_at
            'updated_at' => fn (array $attr) => $attr['created_at'],
        ];
    }

    public function deleted(): static
    {
        return $this->state(['deleted_at' => fn ($attr) => $attr['created_at']]);
    }
}
