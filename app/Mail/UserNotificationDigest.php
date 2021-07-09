<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use App\Exceptions\InvalidNotificationException;
use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Mail\Mailable;

// Not queueable to avoid trap of too many serialize/unserialize.
// Paired with App\Jobs\UserNotificationDigest
class UserNotificationDigest extends Mailable
{
    private $groups = [];
    private $notifications;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $notifications, User $user)
    {
        $this->user = $user;
        $this->notifications = $notifications;
    }

    private function addToGroups(Notification $notification)
    {
        try {
            $class = BroadcastNotificationBase::getNotificationClassFromNotification($notification);
            $baseKey = 'notifications.mail.'.$class::getBaseKey($notification);
            $key = $class::getMailGroupingKey($notification);

            if (!isset($this->groups[$key])) {
                // remove anything not a string because trans doesn't like it.
                $details = array_filter($notification->details ?? [], function ($value) {
                    return is_string($value);
                });

                if (
                    $this->user->getKey() === $notification->source_user_id
                    && trans_exists("{$baseKey}_self", app()->getLocale())
                ) {
                    $baseKey = "{$baseKey}_self";
                }

                $this->groups[$key] = [
                    'text' => osu_trans($baseKey, $details),
                ];
            }

            $link = $class::getMailLink($notification);
            $this->groups[$key]['links'][$link] = '';
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
        foreach ($this->notifications as $notification) {
            $this->addToGroups($notification);
        }

        $groups = array_values($this->groups);
        $user = $this->user;

        return $this
            ->text('emails.user_notification_digest', compact('groups', 'user'))
            ->subject(osu_trans('mail.user_notification_digest.subject'));
    }
}
