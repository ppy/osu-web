<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Notifications\Store;

use App\Events\Fulfillments\HasOrder;
use App\Events\Fulfillments\ValidationFailedEvent;
use Illuminate\Notifications\Messages\SlackMessage;

class ValidationMessage extends Message
{
    private $eventName;
    private $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($eventName, ValidationFailedEvent $event)
    {
        parent::__construct();
        $this->eventName = $eventName;
        $this->event = $event;
    }

    public function toSlack($notifiable)
    {
        $content = "`{$this->notified_at}` | `{$this->eventName}`";
        if ($this->event instanceof HasOrder) {
            $content .= " | Order `{$this->event->getOrder()->getOrderNumber()}`";
        }

        return (new SlackMessage())
            ->http(static::HTTP_OPTIONS)
            ->to(config('payments.notification_channel'))
            ->warning()
            ->content($content)
            ->attachment(function ($attachment) {
                $attachment
                    ->content(implode("\n", $this->event->getErrors()->allMessages()))
                    ->fields($this->event->getContext())
                    ->markdown(['text', 'fields']);

                if ($this->event instanceof HasOrder) {
                    $attachment->title("Order {$this->event->getOrder()->getOrderNumber()}");
                }
            });
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
            'orderId' => $this->event->getOrder()->order_id,
            'context' => $this->event->getContext(),
            'errorMessages' => $this->event->getErrors()->allMessages(),
        ];
    }
}
