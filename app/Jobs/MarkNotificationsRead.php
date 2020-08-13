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

    private $object;
    private $user;

    public function __construct($object, $user)
    {
        $this->object = $object;
        $this->user = $user;
    }

    public function handle()
    {
        if (!($this->object instanceof ForumPost)) {
            throw new Exception('Unknown object to be marked as read: '.get_class($this->object));
        }

        $notifiable = $this->object->topic()->withTrashed()->first();

        if ($notifiable === null) {
            throw new Exception("Can't find topic {$this->object->getKey()} of post {$this->object->getKey()}");
        }

        $notificationTime = $this->object->post_time;
        $notifiableId = $notifiable->getKey();
        $notifiableType = MorphMap::getType($notifiable);

        $notifications = Notification
            ::where('notifiable_type', '=', $notifiableType)
            ->where('notifiable_id', '=', $notifiableId)
            ->where('created_at', '<=', $notificationTime);

        $userNotifications = $this->user
            ->userNotifications()
            ->where('is_read', '=', false)
            ->whereIn('notification_id', $notifications->select('id'));

        $count = $userNotifications->update(['is_read' => true]);
        $notificationIdentity = [
            'category' => Notification::nameToCategory(Notification::FORUM_TOPIC_REPLY),
            'object_id' => $notifiableId,
            'object_type' => $notifiableType,
        ];

        if ($count > 0) {
            event(new NotificationReadEvent($this->user->getKey(), [
                'notifications' => [$notificationIdentity],
                'read_count' => $count,
                'timestamp' => now(),
            ]));
        }
    }
}
