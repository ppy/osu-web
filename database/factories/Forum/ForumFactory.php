<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\Forum;
use Database\Factories\Factory;

class ForumFactory extends Factory
{
    protected $model = Forum::class;

    public function definition(): array
    {
        return [
            'forum_desc' => fn () => $this->faker->sentence(),
            'forum_name' => fn () => $this->faker->catchPhrase(),
            'forum_parents' => [],
            'forum_rules' => '',
            'forum_type' => 1,
        ];
    }

    public function closed(): static
    {
        return $this->state(['forum_type' => 0]);
    }
}
