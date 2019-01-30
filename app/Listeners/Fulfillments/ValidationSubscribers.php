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

use App\Events\Fulfillments\ValidationFailedEvent;
use App\Traits\StoreNotifiable;

class ValidationSubscribers
{
    use StoreNotifiable;

    public function onValidationFailed($eventName, $data)
    {
        $event = $data[0] ?? null;
        if (!($event instanceof ValidationFailedEvent)) {
            \Log::warning("Received `{$eventName}` but is not an instance of `ValidationFailedEvent`.");
            $this->notifyText('missing event data', $eventName);

            return;
        }

        \Log::warning("ValidationFailedEvent: {$eventName}");
        \Log::warning($event->getErrors()->allMessages());
        $this->notifyValidation($event, $eventName);
    }

    public function subscribe($events)
    {
        $events->listen(
            'store.*.validation.failed.*',
            static::class.'@onValidationFailed'
        );
    }
}
