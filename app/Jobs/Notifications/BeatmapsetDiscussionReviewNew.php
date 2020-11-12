<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\BeatmapDiscussion;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;

class BeatmapsetDiscussionReviewNew extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::BEATMAPSET_MODDING;

    protected $beatmapsetDiscussion;

    public static function getBaseKey(Notification $notification): string
    {
        return "{$notification->notifiable_type}.{$notification->category}.beatmapset_discussion_post_new";
    }

    public static function getMailLink(Notification $notification): string
    {
        return route('beatmapsets.discussion', ['beatmapset' => $notification->notifiable_id]).'#/'.$notification->details['discussion_id'];
    }

    public function __construct(BeatmapDiscussion $beatmapsetDiscussion, User $source)
    {
        parent::__construct($source);

        $this->beatmapsetDiscussion = $beatmapsetDiscussion;
    }

    public function getDetails(): array
    {
        $beatmapset = $this->beatmapsetDiscussion->beatmapset;
        $stats = BeatmapsetDiscussionReview::getStats(json_decode($this->beatmapsetDiscussion->startingPost->message, true));

        return [
            'title' => $beatmapset->title,
            'title_unicode' => $beatmapset->title_unicode,
            'post_id' => $this->beatmapsetDiscussion->startingPost->getKey(),
            'discussion_id' => $this->beatmapsetDiscussion->getKey(),
            'beatmap_id' => $this->beatmapsetDiscussion->beatmap_id,
            'cover_url' => $beatmapset->coverURL('card'),
            'embeds' => [
                'suggestions' => $stats['suggestions'],
                'problems' => $stats['problems'],
                'praises' => $stats['praises'],
            ],
        ];
    }

    public function getListeningUserIds(): array
    {
        return $this->beatmapsetDiscussion->beatmapset->watches()->pluck('user_id')->all();
    }

    public function getNotifiable()
    {
        return $this->beatmapsetDiscussion->beatmapset;
    }

    public function handle()
    {
        $this->beatmapsetDiscussion->beatmapset->watches()->update(['last_notified' => $this->getTimestamp()]);

        return parent::handle();
    }
}
