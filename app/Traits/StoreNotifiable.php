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
use App\Notifications\Store\ErrorMessage;
use App\Notifications\Store\OrderMessage;
use App\Notifications\Store\StoreMessage;
use App\Notifications\Store\ValidationMessage;
use Exception;
use Illuminate\Notifications\Notifiable;
use Log;

trait StoreNotifiable
{
    use Notifiable;

    public function routeNotificationForSlack()
    {
        return config('slack.endpoint');
    }

    public function notifyText($text, $eventName = null)
    {
        $this->tryNotify(new StoreMessage($eventName, $text));
    }

    public function notifyOrder($order, $text, $eventName = null)
    {
        $this->tryNotify(new OrderMessage($eventName, $order, $text));
    }

    public function notifyError($exception, $order = null, $eventName = null, $context = [])
    {
        $this->tryNotify(new ErrorMessage($eventName, $exception, $order, $context));
    }

    public function notifyValidation(ValidationFailedEvent $event, $eventName)
    {
        $this->tryNotify(new ValidationMessage($eventName, $event));
    }

    private function tryNotify($message)
    {
        // avoid failing if calling notify fails for any reason.
        try {
            $this->notify($message);
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
