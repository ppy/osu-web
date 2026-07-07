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
        if ($discussion->canBeResolved()) {
            // Avoid loading user models.
            $participantIds = $discussion->beatmapDiscussionPosts->pluck('user_id');
            $notificationOptionsByUserId = UserNotificationOption
                ::where(['name' => static::NOTIFICATION_OPTION_NAME])
                ->whereIn('user_id', $participantIds)
                ->whereNotNull('details')
                ->get()
                ->keyBy('user_id');

            foreach ($participantIds as $participantId) {
                $option = $notificationOptionsByUserId[$participantId] ?? null;
                if ($option?->details[UserNotificationOption::BEATMAPSET_DISCUSSION_REPLY] ?? true) {
                    $userIds->push($participantId);
                }
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
