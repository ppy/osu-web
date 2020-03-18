<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Events\NotificationReadEvent;
use App\Libraries\MorphMap;
use App\Models\Beatmapset;
use App\Models\Forum\Post as ForumPost;
use App\Models\Notification;
use App\Traits\NotificationQueue;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class MarkNotificationsRead implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    private $notifiable;
    private $notificationTime;
    private $object;
    private $user;

    public function __construct($object, $user)
    {
        $this->object = $object;
        $this->user = $user;
    }

    public function forForumPost()
    {
        $this->notifiable = $this->object->topic()->withTrashed()->first();

        if ($this->notifiable === null) {
            throw new Exception("Can't find topic {$this->object->getKey()} of post {$this->object->getKey()}");
        }

        $this->notificationTime = $this->object->post_time;
    }

    public function handle()
    {
        try {
            if ($this->object instanceof Beatmapset) {
                // do nothing
            } elseif ($this->object instanceof ForumPost) {
                $this->forForumPost();
            } else {
                throw new Exception('Unknown object to be marked as read: '.get_class($this->object));
            }
        } catch (Exception $e) {
            log_error($e);

            return;
        }

        if (!isset($this->notifiable)) {
            $this->notifiable = $this->object;
        }

        if (!isset($this->notificationTime)) {
            $this->notificationTime = now();
        }

        $notifications = Notification
            ::where('notifiable_type', '=', MorphMap::getType($this->notifiable))
            ->where('notifiable_id', '=', $this->notifiable->getKey())
            ->where('created_at', '<=', $this->notificationTime);

        $userNotifications = $this->user
            ->userNotifications()
            ->where('is_read', '=', false)
            ->whereIn('notification_id', $notifications->select('id'));

        $notificationIds = $userNotifications->pluck('notification_id')->all();
        $userNotifications->update(['is_read' => true]);

        if (!empty($notificationIds)) {
            event(new NotificationReadEvent($this->user->getKey(), ['ids' => $notificationIds]));
        }
    }
}
