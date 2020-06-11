<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use App\Exceptions\InvalidNotificationException;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationDigest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $fromId;
    private $groups = [];
    private $toId;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, int $fromId, int $toId)
    {
        $this->user = $user;
        $this->fromId = $fromId;
        $this->toId = $toId;
    }

    private function addToGroups(Notification $notification)
    {
        try {
            $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
            $baseKey = 'notifications.mail.'.$class::getBaseKey($notification);
            $key = "{$baseKey}-{$notification->notifiable_type}-{$notification->notifiable_id}";

            if (isset($this->groups[$key])) {
                return;
            }

            $this->groups[$key] = [
                'link' => $class::getMailLink($notification),
                'text' => trans($baseKey, $notification->details),
            ];
        } catch (InvalidNotificationException $e) {
            log_error($e);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $notifications = $this->user->userNotifications()
            ->where('notification_id', '>', $this->fromId)
            ->where('notification_id', '<=', $this->toId)
            ->with('notification.notifiable')
            ->get()
            ->pluck('notification');

        foreach ($notifications as $notification) {
            $this->addToGroups($notification);
        }

        $lines = [];
        foreach ($this->groups as $key => $values) {
            $lines[] = $values['text'];
            $lines[] = $values['link'];
            $lines[] = '';
        }

        return $this->text('emails.user_new_notifications', compact('lines'));
    }
}
