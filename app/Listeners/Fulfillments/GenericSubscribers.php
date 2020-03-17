<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Listeners\Fulfillments;

use App\Events\Fulfillments\HasOrder;
use App\Events\MessageableEvent;
use App\Traits\StoreNotifiable;

class GenericSubscribers
{
    use StoreNotifiable;

    public function onEvent($eventName, $data)
    {
        $event = $data[0] ?? null;

        if (!($event instanceof MessageableEvent)) {
            \Log::warning("Received `{$eventName}` but is not an instance of `MessageableEvent`.");

            return;
        }

        if ($event instanceof HasOrder) {
            $this->notifyOrder(
                $event->getOrder(),
                $event->toMessage(),
                $eventName
            );
        } else {
            $this->notifyText(
                $event->toMessage(),
                $eventName
            );
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'store.fulfillments.run.*',
            static::class.'@onEvent'
        );

        $events->listen(
            'store.fulfillments.revert.*',
            static::class.'@onEvent'
        );
    }
}
