<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\BeatmapsetEvent;
use League\Fractal;

class BeatmapsetEventTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'beatmapset',
        'discussion',
    ];

    public function transform(BeatmapsetEvent $event = null)
    {
        $userId = priv_check('BeatmapsetEventViewUserId', $event)->can() ? $event->user_id : null;

        return [
            'id' => $event->id,
            'type' => $event->type,
            'comment' => $event->comment,
            'created_at' => json_time($event->created_at),
            'user_id' => $userId,
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
}
