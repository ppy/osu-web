<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\NotificationType;
use App\Libraries\Payments\PaymentSignature;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Tests\Libraries\Payments\TestPaymentProcessor as PaymentProcessor;
use Tests\TestCase;

class PaymentProcessorTest extends TestCase
{
    private Order $order;
    private PaymentProcessor $subject;

    public function testCancelWithoutPayment()
    {
        $this->expectsEvents('store.payments.error.test');
        $this->doesntExpectEvents('store.payments.cancelled.test');

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
    }

    public function testCancelWithPayment()
    {
        $this->doesntExpectEvents('store.payments.error.test');
        $this->expectsEvents('store.payments.cancelled.test');

        $payment = $this->order->payments()->create([
            'country_code' => 'CC',
            'paid_at' => now(),
            'provider' => 'test',
            'transaction_id' => $this->order->getProviderReference(),
        ]);

        $this->order->paid($payment);

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
        $this->assertTrue($this->order->payments()->where('cancelled', true)->exists());
    }


    public function testCancelWithCancelledPayment()
    {
        $this->expectsEvents('store.payments.error.test');
        $this->doesntExpectEvents('store.payments.cancelled.test');

        $payment = $this->order->payments()->create([
            'cancelled' => true,
            'country_code' => 'CC',
            'paid_at' => now(),
            'provider' => 'test',
            'transaction_id' => $this->order->getProviderReference(),
        ]);

        $this->order->paid($payment);

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
        $this->assertTrue($this->order->payments()->where('cancelled', true)->exists());
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('store.order.prefix', 'test');

        $this->order = factory(Order::class)->states('checkout')->create([
            'transaction_id' => 'test-123',
        ]);
        factory(OrderItem::class)->states('supporter_tag')->create(['order_id' => $this->order->getKey()]);

        $this->subject = new PaymentProcessor([
            'countryCode' => 'CC',
            'notificationType' => NotificationType::REFUND,
            'orderNumber' => "test-{$this->order->user_id}-{$this->order->getKey()}",
            'paymentTransactionId' => '123',
            'paymentDate' => json_time(now()),
        ], $this->validSignature());
    }

    private function validSignature()
    {
        return new class implements PaymentSignature {
            public function isValid()
            {
                return true;
            }
        };
    }
}
