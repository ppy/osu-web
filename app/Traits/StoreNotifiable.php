<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
