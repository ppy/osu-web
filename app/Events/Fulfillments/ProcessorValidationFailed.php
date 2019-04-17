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

namespace App\Events\Fulfillments;

use App\Libraries\Payments\PaymentProcessor;
use App\Libraries\ValidationErrors;

class ProcessorValidationFailed extends ValidationFailedEvent
{
    public function __construct(PaymentProcessor $sender, ValidationErrors $errors)
    {
        parent::__construct($sender, $errors);
        $this->context = array_merge($this->context, [
            'order_number' => $sender->getOrderNumber(),
            'notification_type' => "{$sender->getNotificationType()} ({$sender->getNotificationTypeRaw()})",
            'transaction_id' => $sender->getTransactionId(),
        ]);
    }

    public function toMessage()
    {
        return "`{$this->context['order_number']}`"
            ." | notification `{$this->context['notification_type']}` `{$this->context['transaction_id']}` | "
            .parent::toMessage();
    }
}
