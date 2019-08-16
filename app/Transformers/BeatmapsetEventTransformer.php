<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
