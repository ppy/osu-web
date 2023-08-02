<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroupEvent;

class UserGroupEventFactory extends Factory
{
    protected $model = UserGroupEvent::class;

    public function configure(): static
    {
        // Fill in details after making the Model so that the caller can set
        // their own details without overwriting the entire array.
        return $this->afterMaking(function (UserGroupEvent $event) {
            $defaultDetails = [
                'actor_name' => $event->actor?->username,
                'group_name' => $event->group->group_name,
                'user_name' => $event->user?->username,
            ];

            match ($event->type) {
                UserGroupEvent::GROUP_RENAME => $defaultDetails['previous_group_name'] =
                    "Old {$event->group->group_name}",

                UserGroupEvent::USER_ADD,
                UserGroupEvent::USER_ADD_PLAYMODES,
                UserGroupEvent::USER_REMOVE_PLAYMODES => $defaultDetails['playmodes'] =
                    $this->faker->randomElements(array_keys(Beatmap::MODES)),

                default => null,
            };

            $event->details = array_merge($defaultDetails, $event->details);
        });
    }

    public function definition(): array
    {
        return [
            'actor_id' => User::factory(),
            'details' => [],
            'group_id' => Group::factory(),
            'hidden' => false,
            'type' => fn () => $this->faker->randomElement([
                UserGroupEvent::GROUP_ADD,
                UserGroupEvent::GROUP_REMOVE,
                UserGroupEvent::GROUP_RENAME,
                UserGroupEvent::USER_ADD,
                UserGroupEvent::USER_ADD_PLAYMODES,
                UserGroupEvent::USER_REMOVE,
                UserGroupEvent::USER_REMOVE_PLAYMODES,
                UserGroupEvent::USER_SET_DEFAULT,
            ]),

            // depends on type
            'user_id' => fn (array $attr) => match ($attr['type']) {
                UserGroupEvent::GROUP_ADD,
                UserGroupEvent::GROUP_REMOVE,
                UserGroupEvent::GROUP_RENAME => null,

                default => User::factory(),
            },
        ];
    }
}
