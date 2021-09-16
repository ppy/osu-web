<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Notifications\Store;

use Illuminate\Notifications\Messages\SlackMessage;

class OrderMessage extends Message
{
    private $eventName;
    private $order;
    private $text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($eventName, $order, $text)
    {
        parent::__construct();
        $this->eventName = $eventName;
        $this->order = $order;
        $this->text = $text;
    }

    public function toSlack($notifiable)
    {
        $content = "`{$this->notified_at}` | `{$this->eventName}` | Order `{$this->order->getOrderNumber()}`: {$this->text}";

        return (new SlackMessage())
            ->http(static::HTTP_OPTIONS)
            ->to(config('payments.notification_channel'))
            ->content($content);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'eventName' => $this->eventName,
            'orderId' => $this->order->order_id,
            'text' => $this->text,
        ];
    }
}
