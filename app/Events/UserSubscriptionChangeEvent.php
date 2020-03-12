<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Follow;
use Illuminate\Broadcasting\Channel;

class UserSubscriptionChangeEvent extends NotificationEventBase
{
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
        parent::__construct();

        $this->action = $action;
        $this->userId = $user->getKey();

        // TODO: consolidate BeatmapsetWatch and TopicWatch to Follow and rename $notifiable to $follow.
        if ($notifiable instanceof Follow) {
            $subtype = $notifiable->subtype;
            $notifiable = $notifiable->notifiable;
        }
        $this->channelName = static::generateChannelName($notifiable, $subtype ?? null);
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
