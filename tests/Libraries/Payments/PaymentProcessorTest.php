<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\NotificationType;
use App\Libraries\Payments\PaymentSignature;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Payment;
use Mockery\MockInterface;
use Sentry;
use Sentry\ClientInterface;
use Tests\Libraries\Payments\TestPaymentProcessor as PaymentProcessor;
use Tests\TestCase;

class PaymentProcessorTest extends TestCase
{
    private Order $order;
    private PaymentProcessor $subject;

    public function testCancelWithoutPayment()
    {
        $sentry = $this->mock(ClientInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('captureMessage')
                ->withArgs(function (string $message) {
                    return $message === PaymentProcessor::WARN_CANCEL_MISSING_PAYMENT;
                })
                ->once();
        });
        Sentry::bindClient($sentry);

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
    }

    public function testCancelWithPayment()
    {
        $payment = $this->order->payments()->create([
            'country_code' => 'CC',
            'paid_at' => now(),
            'provider' => 'test',
            'transaction_id' => $this->order->getTransactionId(),
        ]);

        $this->order->paid($payment);

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
        $this->assertTrue($this->order->payments()->where('cancelled', true)->exists());
    }

    public function testCancelWithCancelledPayment()
    {
        $params = [
            'country_code' => 'CC',
            'paid_at' => now(),
            'provider' => 'test',
            'transaction_id' => $this->order->getTransactionId(),
        ];

        $this->order->paid(new Payment($params));

        $this->order->payments()->create([
            ...$params,
            'cancelled' => true,
        ]);

        $this->order->refresh();

        $sentry = $this->mock(ClientInterface::class, function (MockInterface $mock) {
            $mock->shouldIgnoreMissing()
                ->shouldReceive('captureMessage')
                ->withArgs(function (string $message) {
                    return $message === PaymentProcessor::WARN_PAYMENT_ALREADY_CANCELLED;
                })
                ->once();
        });
        Sentry::bindClient($sentry);

        $this->subject->run();

        $this->order->refresh();

        $this->assertTrue($this->order->isCancelled());
        $this->assertTrue($this->order->payments()->where('cancelled', true)->exists());
    }

    protected function setUp(): void
    {
        parent::setUp();

        config_set('store.order.prefix', 'test');

        $this->order = Order::factory()->paymentApproved()->create([
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
            public function assertValid(): void
            {
            }
        };
    }
}
