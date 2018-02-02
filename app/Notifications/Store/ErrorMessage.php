<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Notifications\Store;

use Illuminate\Notifications\Messages\SlackMessage;
use PayPal\Exception\PayPalConnectionException;

class ErrorMessage extends Message
{
    private $context;
    private $eventName;
    private $exceptionClass;
    private $exceptionData;
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

        if ($exception instanceof PayPalConnectionException) {
            $this->exceptionData = $exception->getData();
        }

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

        return (new SlackMessage)
            ->http(static::HTTP_OPTIONS)
            ->to(config('payments.notification_channel'))
            ->error()
            ->content($content)
            ->attachment(function ($attachment) {
                $fields = $this->context;
                if (isset($this->exceptionData)) {
                    $fields = array_merge($fields, ['data' => $this->exceptionData]);
                }

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

        if (isset($this->exceptionData)) {
            $array['data'] = $this->exceptionData;
        }

        return $array;
    }
}
