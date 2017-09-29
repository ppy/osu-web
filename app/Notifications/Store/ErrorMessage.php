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
    private $text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exception, $order = null, $text = null)
    {
        $this->exception = $exception;
        $this->order = $order;
        $this->text = $text;
    }

    public function toSlack($notifiable)
    {
        $content = 'ERROR:';

        if ($this->order) {
            $content .= " `Order {$this->order->order_id}`";
        }

        if ($this->text) {
            $content .= '; ';
            $content .= $this->text;
        }

        if ($this->exception) {
            $className = get_class($this->exception);
            $content .= "; `{$className}`";

            if ($this->exception instanceof PayPalConnectionException) {
                $content .= "\n";
                $content .= $this->exception->getData();
            }
        }

        return (new SlackMessage)
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
            //
        ];
    }
}
