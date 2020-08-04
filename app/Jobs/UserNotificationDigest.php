<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Mail\UserNotificationDigest as UserNotificationDigestMail;
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

    public function __construct(User $user, int $fromId, int $toId)
    {
        $this->user = $user;
        $this->fromId = $fromId;
        $this->toId = $toId;
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
        $filtered = [];

        foreach ($notifications as $notification) {
            if (!$this->shouldSend($notification)) {
                continue;
            }

            $filtered[] = $notification;
        }

        return $filtered;
    }

    private function shouldSend(Notification $notification)
    {
        if ($notification->notifiable_type === 'beatmapset') {
            $watch = $notification->notifiable->watches()->forUser($this->user)->first();
            if ($watch === null) { // watch has been removed since...
                return false;
            }

            // don't add to digest if this particular type has already been notified and user hasn't caught up yet.
            return $watch->isRead()
                && $watch->last_read < now(); // should have already been marked as read, though?
        } else if ($notification->notifiable_type === 'forum_topic') {
            $watch = $notification->notifiable
                ->watches()
                ->forUser($this->user)
                ->where('mail', true)
                ->where('notify_status', false)
                ->first();

            if ($watch === null) { // watch has been removed since...
                return false;
            }
        }

        return true;
    }
}
