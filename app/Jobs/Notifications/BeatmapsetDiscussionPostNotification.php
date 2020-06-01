<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\BeatmapDiscussionPost;
use App\Models\User;
use App\Models\UserNotificationOption;

abstract class BeatmapsetDiscussionPostNotification extends BroadcastNotificationBase
{
    public function __construct(BeatmapDiscussionPost $object, ?User $source = null)
    {
        parent::__construct($object, $source);
    }

    public function getDetails(): array
    {
        return [
            'content' => truncate($this->object->message, static::CONTENT_TRUNCATE),
            'title' => $this->getNotifiable()->title,
            'post_id' => $this->object->getKey(),
            'discussion_id' => $this->object->beatmapDiscussion->getKey(),
            'beatmap_id' => $this->object->beatmapDiscussion->beatmap_id,
            'cover_url' => $this->getNotifiable()->coverURL('card'),
        ];
    }

    public function getListentingUserIds(): array
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
