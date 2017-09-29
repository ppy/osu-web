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

use App\Events\Fulfillments\ValidationFailedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class ValidationMessage extends Notification
{
    use Queueable;

    private $eventName;
    private $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($eventName, ValidationFailedEvent $event)
    {
        $this->eventName = $eventName;
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $content = "`{$this->eventName}`";
        if ($this->event instanceof \App\Events\Fulfillments\HasOrder) {
            $content .= " | `Order {$this->event->getOrder()->order_id}`";
        }

        return (new SlackMessage)
            ->to(config('payments.notification_channel'))
            ->warning()
            ->content($content)
            ->attachment(function ($attachment) {
                $attachment
                    ->content(implode("\n", $this->event->getErrors()->allMessages()))
                    ->fields($this->event->getContext())
                    ->markdown(['text', 'fields']);

                if ($this->event instanceof \App\Events\Fulfillments\HasOrder) {
                    $attachment->title("Order {$this->event->getOrder()->order_id}");
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
            //
        ];
    }
}
