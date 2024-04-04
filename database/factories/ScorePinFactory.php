<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\ScorePin;
use App\Models\Solo;
use App\Models\User;

class ScorePinFactory extends Factory
{
    protected $model = ScorePin::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'display_order' => rand(-1000, 1000),
        ];
    }

    public function withScore(Solo\Score $score): static
    {
        return $this
            ->state([
                'ruleset_id' => Beatmap::MODES[$score->getMode()],
                'score_id' => $score->getKey(),
                'score_type' => $score->getMorphClass(),
                'user_id' => $score->user,
            ])->for($score, 'score');
    }
}
