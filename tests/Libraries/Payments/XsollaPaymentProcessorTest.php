<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\Store\PaymentProcessorException;
use App\Libraries\Payments\PaymentSignature;
use App\Libraries\Payments\XsollaPaymentProcessor;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Tests\TestCase;

class XsollaPaymentProcessorTest extends TestCase
{
    private Order $order;

    public function testWhenEverythingIsFine()
    {
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());
        $subject->run();

        $this->assertTrue($subject->validationErrors()->isEmpty());
    }

    public function testWhenPaymentIsInsufficient()
    {
        $orderItem = OrderItem::factory()->supporterTag()->create(['order_id' => $this->order]);

        $params = $this->getTestParams([
            'purchase' => [
                'checkout' => [
                    'currency' => 'USD',
                    'amount' => $orderItem->cost - 1,
                ],
            ],
        ]);

        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        $this->expectExceptionCallable(fn () => $subject->run(), PaymentProcessorException::class);

        $this->assertArrayHasKey('purchase.checkout.amount', $subject->validationErrors()->all());
    }

    public function testWhenUserIdMismatch()
    {
        $orderNumber = 'store-'
                           .($this->order->user_id + 10) // just make it bigger than whatever the factory generated
                           .'-'
                           .$this->order->order_id;

        $params = $this->getTestParams([
            'transaction' => [
                'external_id' => $orderNumber,
            ],
        ]);

        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        $this->expectExceptionCallable(fn () => $subject->run(), PaymentProcessorException::class);

        $this->assertArrayHasKey('order', $subject->validationErrors()->all());
    }

    public function testWhenOrderNumberMalformed()
    {
        $orderNumber = "{$this->order->getOrderNumber()}-oops";

        $params = $this->getTestParams([
            'transaction' => [
                'external_id' => $orderNumber,
            ],
        ]);

        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        $this->expectExceptionCallable(fn () => $subject->run(), PaymentProcessorException::class);

        $this->assertArrayHasKey('order', $subject->validationErrors()->all());
    }

    public function testWhenSignatureInvalid()
    {
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->invalidSignature());

        $this->expectException(InvalidSignatureException::class);

        $subject->run();
    }

    public function testWhenOrderProcessingState()
    {
        $this->order = Order::factory()->paymentRequested()->create();
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());
        $subject->run();

        $this->assertTrue($subject->validationErrors()->isEmpty());
    }

    public function testWhenOrderHasPhysicalItems()
    {
        $orderItem = OrderItem::factory()->create(['order_id' => $this->order]);

        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        $this->expectExceptionCallable(fn () => $subject->run(), PaymentProcessorException::class);

        $this->assertArrayHasKey('order.items', $subject->validationErrors()->all());
    }

    protected function setUp(): void
    {
        parent::setUp();
        config_set('payments.xsolla.api_key', 'api_key');
        $this->order = Order::factory()->paymentApproved()->create();
    }

    private function getTestParams(array $overrides = [])
    {
        $order = $this->order;

        $base = [
            'notification_type' => 'payment',
            'nothing' => 'to see',
            'transaction' => [
                'id' => '123456789',
                'external_id' => $order->getOrderNumber(),
            ],
            'purchase' => [
                'checkout' => [
                    'currency' => 'USD',
                    'amount' => $order->getTotal(),
                ],
            ],
        ];

        return array_merge($base, $overrides);
    }

    private function validSignature()
    {
        return new class implements PaymentSignature {
            public function assertValid(): void
            {
            }
        };
    }

    private function invalidSignature()
    {
        return new class implements PaymentSignature {
            public function assertValid(): void
            {
                throw new InvalidSignatureException();
            }
        };
    }
}
