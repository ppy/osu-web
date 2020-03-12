<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
