<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\NotificationType;
use App\Libraries\Payments\PaymentSignature;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Illuminate\Support\Facades\Event;
use Tests\Libraries\Payments\TestPaymentProcessor as PaymentProcessor;
use Tests\TestCase;

class PaymentProcessorTest extends TestCase
{
    private Order $order;
    private PaymentProcessor $subject;

    public function testCancelWithoutPayment()
    {
        Event::fake();

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
        Event::assertDispatched('store.payments.error.test');
        Event::assertNotDispatched('store.payments.cancelled.test');
    }

    public function testCancelWithPayment()
    {
        Event::fake();

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
        Event::assertNotDispatched('store.payments.error.test');
        Event::assertDispatched('store.payments.cancelled.test');
    }


    public function testCancelWithCancelledPayment()
    {
        Event::fake();

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
        Event::assertDispatched('store.payments.error.test');
        Event::assertNotDispatched('store.payments.cancelled.test');
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('store.order.prefix', 'test');

        $this->order = Order::factory()->checkout()->create([
            'transaction_id' => 'test-123',
        ]);
        OrderItem::factory()->supporterTag()->create(['order_id' => $this->order]);

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
