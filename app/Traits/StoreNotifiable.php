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

namespace App\Traits;

use App\Events\Fulfillments\ValidationFailedEvent;
use PayPal\Exception\PayPalConnectionException;
use Slack;

trait StoreNotifiable
{
    public function notify($text, $eventName = null)
    {
        if ($eventName) {
            $text = "`{$eventName}` | {$text}";
        }

        Slack::to(config('payments.notification_channel'))->send($text);
    }

    public function notifyOrder($order, $text, $eventName = null)
    {
        $msg = '';
        if ($eventName) {
            $msg = "`{$eventName}` | ";
        }

        $msg .= "`Order {$order->order_id}`: {$text}";

        Slack::to(config('payments.notification_channel'))->send($msg);
    }

    public function notifyError($order = null, $exception = null, $text = null)
    {
        $message = 'ERROR:';

        if ($order) {
            $message .= " `Order {$order->order_id}`";
        }

        if ($text) {
            $message .= '; ';
            $message .= $text;
        }

        if ($exception) {
            $className = get_class($exception);
            $message .= "; `{$className}`";

            if ($exception instanceof PayPalConnectionException) {
                $message .= "\n";
                $message .= $exception->getData();
            }
        }

        Slack::to('test-hooks')->send($message);
    }

    public function notifyValidation(ValidationFailedEvent $event, $eventName)
    {
        $msg = "`{$eventName}`";
        if ($event instanceof \App\Events\Fulfillments\HasOrder) {
            $msg .= " | `Order {$event->getOrder()->order_id}`";
        }

        $fields = [];
        foreach ($event->getContext() as $key => $value) {
            $fields[] = [
                'title' => $key,
                'value' => $value,
                'short' => true,
            ];
        }

        Slack::to(config('payments.notification_channel'))
            ->attach([
                'color' => 'warning',
                'fallback' => "{$msg} | {$event->toMessage()}",
                'text' => implode("\n", $event->getErrors()->allMessages()),
                'fields' => $fields,
                'mrkdwn_in' => ['text'],
            ])
            ->send($msg);
    }
}
