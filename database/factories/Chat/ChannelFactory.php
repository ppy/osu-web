<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Chat;

use App\Models\Chat\Channel;
use App\Models\LegacyMatch\LegacyMatch;
use Database\Factories\Factory;

class ChannelFactory extends Factory
{
    protected $model = Channel::class;

    public function definition(): array
    {
        return [
            'name' => '#'.$this->faker->colorName(),
            'description' => $this->faker->bs(),
        ];
    }

    public function moderated()
    {
        return $this->state(['moderated' => true]);
    }

    public function tourney()
    {
        $match = factory(LegacyMatch::class)->states('tourney')->create();

        return $this->state([
            'name' => "#mp_{$match->getKey()}",
            'type' => Channel::TYPES['temporary'],
        ]);
    }

    public function type(string $type)
    {
        if ($type === 'tourney') {
            return $this->tourney();
        }

        return $this->state(['type' => Channel::TYPES[$type]]);
    }
}
