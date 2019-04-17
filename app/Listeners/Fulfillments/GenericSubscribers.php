<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
