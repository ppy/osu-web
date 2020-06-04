<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\BeatmapDiscussion;
use App\Models\User;
use App\Models\UserNotificationOption;

class BeatmapsetDiscussionReviewNew extends BroadcastNotificationBase
{
    public function __construct(BeatmapDiscussion $object, User $source)
    {
        parent::__construct($object, $source);
    }

    public function getDetails(): array
    {
        $stats = BeatmapsetDiscussionReview::getStats(json_decode($this->object->startingPost->message, true));

        return [
            'title' => $this->getNotifiable()->title,
            'post_id' => $this->object->startingPost->getKey(),
            'discussion_id' => $this->object->getKey(),
            'beatmap_id' => $this->object->beatmap_id,
            'cover_url' => $this->getNotifiable()->coverURL('card'),
            'embeds' => [
                'suggestions' => $stats['suggestions'],
                'problems' => $stats['problems'],
                'praises' => $stats['praises'],
            ],
        ];
    }

    public function getListeningUserIds(): array
    {
        return static::filterUserIdsForNotificationOption(
            $this->getNotifiable()->watches()->pluck('user_id')->all(),
            UserNotificationOption::BEATMAPSET_MODDING
        );
    }

    public function getNotifiable()
    {
        return $this->object->beatmapset;
    }
}
