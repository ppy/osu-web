<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
