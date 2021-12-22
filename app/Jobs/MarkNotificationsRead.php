<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Events\NotificationReadEvent;
use App\Libraries\MorphMap;
use App\Models\Forum\Post as ForumPost;
use App\Models\Notification;
use App\Models\UserNotification;
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

        // TODO: should look at supporting marking stacks up to a certain point as read client side.
        $userNotifications = UserNotification::where('user_id', $this->user->getKey())
            ->where('is_read', false)
            ->whereHas('notification', function ($query) use ($notifiable) {
                $query
                    ->where('notifiable_type', MorphMap::getType($notifiable))
                    ->where('notifiable_id', $notifiable->getKey())
                    ->where('created_at', '<=', $this->object->post_time);
            });

        // only fetch the models that require marking as read.
        $notifications = Notification::whereIn('id', (clone $userNotifications)->select('notification_id'))->get();
        $notificationIdentities = $notifications->map->toIdentityJson()->all();

        $count = $userNotifications->update(['is_read' => true]);

        if ($count > 0) {
            (new NotificationReadEvent($this->user->getKey(), [
                'notifications' => $notificationIdentities,
                'read_count' => $count,
                'timestamp' => now(),
            ]))->broadcast();
        }
    }
}
