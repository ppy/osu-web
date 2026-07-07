<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;

class BeatmapDiscussionFactory extends Factory
{
    // TODO: decouple message_type
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

    public function configure(): static
    {
        return $this->afterCreating(
            fn (BeatmapDiscussion $discussion) => $discussion->beatmapDiscussionPosts()->save(
                BeatmapDiscussionPost::factory()->state(['user_id' => $discussion->user_id])->make()
            )
        );
    }

    public function definition(): array
    {


        return [
            ...array_rand_val(static::DEFAULTS),
            'beatmapset_id' => Beatmapset::factory(),
            'resolved' => false,
            'user_id' => User::factory(),
        ];
    }

    public function general()
    {
        return $this->state(static::DEFAULTS['general']);
    }

    public function mapperNote()
    {
        return $this->messageType('mapper_note');
    }

    public function messageType(string $type)
    {
        return $this->state(['message_type' => $type]);
    }

    public function problem()
    {
        return $this->messageType('problem');
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
