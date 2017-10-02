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
    private $exception;
    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exception, $order)
    {
        $this->exception = $exception;
        $this->order = $order;
    }

    public function toSlack($notifiable)
    {
        $content = 'ERROR';
        if ($this->order) {
            $content .= " | `Order {$this->order->order_id}`";
        }

        $className = get_class($this->exception);
        $content .= "; `{$className}`";

        return (new SlackMessage)
            ->to(config('payments.notification_channel'))
            ->error()
            ->content($content)
            ->attachment(function ($attachment) {
                $attachment->content($this->exception->getMessage());

                if ($this->exception instanceof PayPalConnectionException) {
                    $attachment->fields([
                        'data' => $this->exception->getData(),
                    ]);
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
        $array = [
            'className' => get_class($this->exception),
            'message' => $this->exception->getMessage(),
        ];

        if ($this->order) {
            $array['orderId'] = $this->order->order_id;
        }

        if ($this->exception instanceof PayPalConnectionException) {
            $array['data'] = $this->exception->getData();
        }

        return $array;
    }
}
