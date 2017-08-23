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

namespace App\Listeners\Fulfillment;

use App\Events\Fulfillment\FulfillmentValidationFailed;
use App\Events\Fulfillment\ProcessorValidationFailed;
use App\Events\Fulfillment\ValidationFailedEvent;

class ValidationSubscribers
{
    use Notifiable;

    public function onValidationFailed($event)
    {
        \Log::debug('ValidationFailedEvent:');
        \Log::debug($event->getErrors()->allMessages());
        $this->notify($event->toMessage());
    }

    public function subscribe($events)
    {
        $events->listen(
            ValidationFailedEvent::class,
            static::class.'@onValidationFailed'
        );

        $events->listen(
            FulfillmentValidationFailed::class,
            static::class.'@onValidationFailed'
        );

        $events->listen(
            ProcessorValidationFailed::class,
            static::class.'@onValidationFailed'
        );
    }
}
