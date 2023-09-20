<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\LegacyMatch;

use App\Models\LegacyMatch\Event;
use App\Models\LegacyMatch\Game;
use App\Models\LegacyMatch\LegacyMatch;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'match_id' => LegacyMatch::factory(),
            'timestamp' => fn() => Carbon::now(),
            'user_id' => User::factory(),
        ];
    }

    public function stateCreate(): static
    {
        return $this->state([
            'text' => 'CREATE',
            'user_id' => null,
        ]);
    }

    public function disband(): static
    {
        return $this->state([
            'text' => 'DISBAND',
            'user_id' => null,
        ]);
    }

    public function join(): static
    {
        return $this->state(['text' => 'JOIN']);
    }

    public function part(): static
    {
        return $this->state(['text' => 'PART']);
    }

    public function game(): static
    {
        return $this->state([
            'game_id' => Game::factory()->inProgress(),
            'text' => 'test game',
            'user_id' => null,
        ]);
    }
}
