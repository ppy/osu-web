<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Libraries\MorphMap;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'details' => [],
            'name' => array_rand(Notification::NAME_TO_CATEGORY),
            'notifiable_id' => rand(),
            'notifiable_type' => array_rand_val(MorphMap::MAP),
        ];
    }
}
