<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Notifications\Store;

use Illuminate\Notifications\Messages\SlackMessage;

class ErrorMessage extends Message
{
    private $context;
    private $eventName;
    private $exceptionClass;
    private $exceptionMessage;
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($eventName, $exception, $order, $context = [])
    {
        parent::__construct();
        $this->context = $context;
        $this->eventName = $eventName;
        $this->exceptionClass = get_class($exception);
        $this->exceptionMessage = $exception->getMessage();
        $this->order = $order;
    }

    public function toSlack($notifiable)
    {
        $content = "ERROR `{$this->notified_at}` | `{$this->eventName}`";
        if ($this->order) {
            $content .= " | Order `{$this->order->getOrderNumber()}`";
        }

        $content .= "; `{$this->exceptionClass}`";

        return (new SlackMessage())
            ->http(static::HTTP_OPTIONS)
            ->to(config('payments.notification_channel'))
            ->error()
            ->content($content)
            ->attachment(function ($attachment) {
                $fields = $this->context;

                $attachment->content($this->exceptionMessage);
                $attachment->fields($fields);
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
        $array = [
            'className' => $this->exceptionClass,
            'message' => $this->exceptionMessage,
        ];

        if ($this->order) {
            $array['orderId'] = $this->order->order_id;
        }

        return $array;
    }
}
