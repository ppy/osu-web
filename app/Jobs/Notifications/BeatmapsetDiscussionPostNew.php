<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\UserNotificationOption;

class BeatmapsetDiscussionPostNew extends BeatmapsetDiscussionPostNotification
{
    #[\Override]
    public function getListeningUserIds(): array
    {
        $userIds = $this->beatmapsetDiscussionPost->beatmapset->watches()->pluck('user_id');

        $discussion = $this->beatmapsetDiscussionPost->beatmapDiscussion;
        if ($discussion->canBeResolved() && $discussion->user_id !== null) {
            if ($discussion->user?->notificationOptions()->where('name', static::NOTIFICATION_OPTION_NAME)->first()?->details[UserNotificationOption::BEATMAPSET_DISCUSSION_REPLY] ?? true) {
                $userIds->push($discussion->user_id);
            }
        }

        return $userIds->all();
    }

    #[\Override]
    public function handle()
    {
        $this->beatmapsetDiscussionPost->beatmapset->watches()->update(['last_notified' => $this->getTimestamp()]);

        parent::handle();
    }
}
