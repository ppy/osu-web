<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;

class NewNotificationEvent extends NotificationEventBase
{
    use SerializesModels;

    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        parent::__construct();

        $this->notification = $notification;
    }

    public function broadcastAs()
    {
        return 'new';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channelName());
    }

    public function broadcastWith()
    {
        return json_item($this->notification, 'Notification');
    }

    private function channelName()
    {
        return static::generateChannelName(
            $this->notification->notifiable,
            Notification::SUBTYPES[$this->notification->name] ?? null
        );
    }
}
