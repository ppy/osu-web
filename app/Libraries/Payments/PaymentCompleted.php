<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Payments;

use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Mail\StorePaymentCompleted;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Mail;
use Sentry\Severity;
use Sentry\State\Scope;

class PaymentCompleted
{
    private array $fulfillers;

    public function __construct(private Order $order, private ?Payment $payment)
    {
        $this->fulfillers = FulfillmentFactory::createFulfillersFor($order);
    }

    private function sendPaymentCompletedMail()
    {
        if (!$this->order->isPaidOrDelivered()) {
            app('sentry')->getClient()->captureMessage(
                'Trying to send mail for unpaid order',
                Severity::warning(),
                (new Scope())->setExtra('order_id', $this->order->getKey())
            );

            return;
        }

        $user = $this->order->user;
        if (is_valid_email_format($user->user_email)) {
            Mail::to($user)->queue(new StorePaymentCompleted($this->order));
        }
    }

    public function handle()
    {
        $connection = $this->order->getConnection();

        $connection->afterCommit(
            function () {
                $this->sendPaymentCompletedMail();

                \Datadog::increment(
                    "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.payments.completed",
                    1,
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
}
