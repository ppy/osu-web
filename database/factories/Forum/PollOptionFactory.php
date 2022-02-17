<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Forum;

use App\Models\Forum\PollOption;
use App\Models\Forum\Topic;
use Database\Factories\Factory;

class PollOptionFactory extends Factory
{
    protected $model = PollOption::class;

    public function definition(): array
    {
        return [
            'poll_option_text' => fn () => $this->faker->sentence(),
            'topic_id' => Topic::factory()->poll(false),
        ];
    }
}
