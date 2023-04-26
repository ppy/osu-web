<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Chat;

use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\LegacyMatch\LegacyMatch;
use App\Models\User;
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

    public function moderated(): static
    {
        return $this->state(['moderated' => true]);
    }

    public function pm(User ...$users): static
    {
        if (empty($users)) {
            $users = User::factory()->count(2)->create();
        }

        if (count($users) !== 2) {
            throw new InvariantException('Creating PM Channels requires 2 users.');
        }

        return $this->state([
            'name' => Channel::getPMChannelName(...$users),
            'type' => Channel::TYPES['pm'],
            'description' => '',
        ])->withUsers(...$users);
    }

    public function tourney(): static
    {
        $match = LegacyMatch::factory()->tourney()->create();

        return $this->state([
            'name' => "#mp_{$match->getKey()}",
            'type' => Channel::TYPES['temporary'],
        ]);
    }

    public function type(string $type, array $users = []): static
    {
        if ($type === 'tourney') {
            return $this->tourney();
        } elseif ($type === 'pm') {
            return $this->pm(...$users);
        }

        return $this->state(['type' => Channel::TYPES[$type]])->withUsers(...$users);
    }

    public function withUsers(User ...$users): static
    {
        return $this->afterCreating(function (Channel $channel) use ($users) {
            foreach ($users as $user) {
                $channel->addUser($user);
            }
        });
    }
}
