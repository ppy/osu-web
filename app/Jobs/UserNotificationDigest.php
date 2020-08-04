<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
use App\Models\Forum\Topic;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Mail;

class UserNotificationDigest implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $fromId;
    private $toId;
    private $user;

    private $beatmapsetWatches;
    private $topicWatches;
    private $now;

    public function __construct(User $user, int $fromId, int $toId)
    {
        $this->user = $user;
        $this->fromId = $fromId;
        $this->toId = $toId;
        $this->now = now();
    }

    public function handle()
    {
        $notifications = $this->filterNotifications($this->getNotifications());

        if (empty($notifications)) {
            return;
        }

        // TODO: catch and log errors?
        Mail::to($this->user)->sendNow(new UserNotificationDigestMail($notifications, $this->user));
    }

    private function getNotifications()
    {
        return Notification
            ::whereHas('userNotifications', function ($q) {
                $q->where('user_id', $this->user->getKey())
                    ->where('is_read', false)
                    ->hasMailDelivery();
            })
            ->where('id', '>', $this->fromId)
            ->where('id', '<=', $this->toId)
            ->get();
    }

    private function filterNotifications(Collection $notifications)
    {
        $this->beatmapsetWatches = $this->user->beatmapsetWatches()
            ->whereIn('beatmapset_id', $notifications->where('notifiable_type', '=', 'beatmapset')->pluck('notifiable_id'))
            ->where('last_read', '<', $this->now)
            ->read()
            ->get()
            ->keyBy('beatmapset_id');

        $this->topicWatches = $this->user->topicWatches()
            ->whereIn('topic_id', $notifications->where('notifiable_type', '=', 'forum_topic')->pluck('notifiable_id'))
            ->where('mail', true)
            ->where('notify_status', false)
            ->get()
            ->keyBy('topic_id');

        $filtered = [];

        foreach ($notifications as $notification) {
            if (!$this->shouldSend($notification)) {
                continue;
            }

            $filtered[] = $notification;
        }

        $this->user->beatmapsetWatches()->whereIn('beatmapset_id', $this->beatmapsetWatches->keys()->all())->update(['last_notified' => $this->now]);
        $this->user->topicWatches()->whereIn('topic_id', $this->topicWatches->keys()->all())->update(['notify_status' => true]);

        return $filtered;
    }

    private function shouldSend(Notification $notification)
    {
        if ($notification->notifiable_type === 'beatmapset') {
            $watch = $this->beatmapsetWatches[$notification->notifiable_id] ?? null;
            if ($watch === null) { // watch might have been removed between now and when notification was created.
                return false;
            }

            // don't add to digest if this particular type has already been notified and user hasn't caught up yet.
            return $watch->last_notified < $this->now;
        } else if ($notification->notifiable_type === 'forum_topic') {
            $watch = $this->topicWatches[$notification->notifiable_id] ?? null;

            return $watch !== null;
        }

        return true;
    }
}
