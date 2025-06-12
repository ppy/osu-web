<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contest;
use App\Models\ContestJudge;
use App\Models\User;

class ContestJudgeFactory extends Factory
{
    protected $model = ContestJudge::class;

    public function definition(): array
    {
        return [
            'contest_id' => Contest::factory()->judged(),
            'user_id' => User::factory(),
        ];
    }

    public function withVotes(): static
    {
        return $this->afterCreating(function (ContestJudge $contestJudge) {
            $contest = $contestJudge->contest;
            $categories = $contest->scoringCategories;

            foreach ($contest->entries as $entry) {
                $vote = $entry->judgeVotes()->create([
                    'comment' => $this->faker->sentence(),
                    'user_id' => $contestJudge->user_id,
                ]);

                foreach ($categories as $category) {
                    $vote->scores()->create([
                        'contest_scoring_category_id' => $category->getKey(),
                        'value' => rand(1, $category->max_value),
                    ]);
                }
            }
        });
    }
}
