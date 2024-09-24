<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\BeatmapsetEvent;

class BeatmapsetEventFactory extends Factory
{
    protected $model = BeatmapsetEvent::class;

    public function configure()
    {
        return $this->afterCreating(function (BeatmapsetEvent $event) {
            if ($event->type === BeatmapsetEvent::NOMINATE) {
                $event->beatmapset->beatmapsetNominations()->create([
                    'event_id' => $event->getKey(),
                    'modes' => $event['comment']['modes'],
                    'user_id' => $event->user_id,
                ]);
            }
        });
    }

    public function definition()
    {
        return [];
    }
}
