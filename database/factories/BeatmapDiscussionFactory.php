<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\BeatmapDiscussion;

class BeatmapDiscussionFactory extends Factory
{
    const DEFAULTS = [
        'general' => [
            'timestamp' => null,
            'message_type' => 'problem',
        ],
        'review' => [
            'timestamp' => null,
            'message_type' => 'review',
        ],
        'timeline' => [
            'timestamp' => 0,
            'message_type' => 'problem',
        ],
    ];

    protected $model = BeatmapDiscussion::class;

    public function definition(): array
    {
        return array_rand_val(static::DEFAULTS);
    }

    public function general()
    {
        return $this->state(static::DEFAULTS['general']);
    }

    public function review()
    {
        return $this->state(static::DEFAULTS['review']);
    }

    public function timeline()
    {
        return $this->state(static::DEFAULTS['timeline']);
    }
}
