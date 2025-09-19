<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Payments;

use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Mail\StorePaymentCompleted;
use App\Models\Store\Order;
use App\Models\Store\Payment;

class PaymentCompleted
{
    private array $fulfillers;

    public function __construct(private Order $order, private ?Payment $payment)
    {
        $this->fulfillers = FulfillmentFactory::createFulfillersFor($order);
    }

    public function handle()
    {
        $connection = $this->order->getConnection();

        $connection->afterCommit(
            function () {
                $this->sendPaymentCompletedMail();

                datadog_increment(
                    'store.payments.completed',
                    ['provider' => $this->payment?->provider ?? 'free'],
                );
            }
        );

        $connection->transaction(function () {
            // Using a unique constraint, so we don't need to lockSelf() first.
            $this->order->paid($this->payment);

            foreach ($this->fulfillers as $fulfiller) {
                $fulfiller->run();
            }
        });
    }

    private function sendPaymentCompletedMail()
    {
        $user = $this->order->user;
        if (is_valid_email_format($user->user_email)) {
            \Mail::to($user)->queue(new StorePaymentCompleted($this->order));
        }
    }
}
