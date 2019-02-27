<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Jobs\MarkNotificationsRead;

use App\Events\NotificationReadEvent;
use App\Libraries\MorphMap;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class ForumTopic implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $post;
    private $user;

    public function __construct($user, $post)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function handle()
    {
        $topic = $this->post->topic()->withTrashed()->first();

        if ($topic === null) {
            return;
        }

        $notifications = Notification
            ::where('notifiable_type', '=', MorphMap::getType($topic))
            ->where('notifiable_id', '=', $topic->getKey())
            ->where('created_at', '<=', $this->post->post_time);
        $userNotifications = $this->user
            ->userNotifications()
            ->where('is_read', '=', false)
            ->whereIn('notification_id', $notifications->select('id'))
            ->get();

        $notificationIds = $userNotifications->pluck('notification_id')->all();
        $userNotifications->each->update(['is_read' => true]);

        if (!empty($notificationIds)) {
            event(new NotificationReadEvent($this->user->getKey(), $notificationIds));
        }
    }
}
