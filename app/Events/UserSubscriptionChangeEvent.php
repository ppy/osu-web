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

namespace App\Events;

use App\Models\Notification;
use App\Traits\NotificationEventConnection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSubscriptionChangeEvent implements ShouldBroadcast
{
    use NotificationEventConnection;

    public $action;
    public $userId;
    public $channelName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $user, $notifiable)
    {
        $this->action = $action;
        $this->userId = $user->getKey();
        $this->channelName = Notification::generateChannelName($notifiable);
    }

    public function broadcastAs()
    {
        return $this->action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("user_subscription:{$this->userId}");
    }

    public function broadcastWith()
    {
        return ['channel' => $this->channelName];
    }
}
