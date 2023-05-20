<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\BeatmapsetEvent;

class BeatmapsetEventTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'beatmapset',
        'discussion',
    ];

    protected array $defaultIncludes = [
        'user_id',
    ];

    protected $permissions = [
        'user_id' => 'BeatmapsetEventViewUserId',
    ];

    public function transform(BeatmapsetEvent $event = null)
    {
        return [
            'id' => $event->id,
            'type' => $event->type,
            'comment' => $event->comment,
            'created_at' => json_time($event->created_at),
        ];
    }

    public function includeBeatmapset(BeatmapsetEvent $event)
    {
        if ($event->beatmapset === null) {
            return;
        }

        return $this->item(
            $event->beatmapset,
            new BeatmapsetCompactTransformer()
        );
    }

    public function includeDiscussion(BeatmapsetEvent $event)
    {
        if ($event->beatmapDiscussion === null) {
            return;
        }

        return $this->item(
            $event->beatmapDiscussion,
            new BeatmapDiscussionTransformer()
        );
    }

    public function includeUserId(BeatmapsetEvent $event)
    {
        return $this->primitive($event->user_id);
    }
}
