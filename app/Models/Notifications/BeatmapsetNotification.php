<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use App\Models\UserNotificationOption;

abstract class BeatmapsetNotification extends NotificationBase
{
    protected static function beatmapsetWatcherUserIds($beatmapset)
    {
        return static::filterUserIdsForNotificationOption(
            $beatmapset->watches()->pluck('user_id')->all(),
            UserNotificationOption::BEATMAPSET_MODDING
        );
    }

    public function __construct($object, ?User $source)
    {
        parent::__construct($object, $source);

        if ($object instanceof BeatmapDiscussionPost) {
            $this->notifiable = $object->beatmapset;
        } else {
            $this->notifiable = $object;
        }
    }

    public function getDetails(): array
    {
        if ($this->object instanceof BeatmapDiscussionPost) {
            return [
                'content' => truncate($this->object->message, static::CONTENT_TRUNCATE),
                'title' => $this->notifiable->title,
                'post_id' => $this->object->getKey(),
                'discussion_id' => $this->object->beatmapDiscussion->getKey(),
                'beatmap_id' => $this->object->beatmapDiscussion->beatmap_id,
                'cover_url' => $this->notifiable->coverURL('card'),
            ];
        } else if ($this->object instanceof Beatmapset) {
            return [
                'title' => $this->object->title,
                'cover_url' => $this->object->coverURL('card'),
            ];
        }
    }

    public function getListentingUserIds(): array
    {
        return static::beatmapsetWatcherUserIds($this->notifiable);
    }
}
