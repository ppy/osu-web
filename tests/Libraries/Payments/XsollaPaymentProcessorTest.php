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

namespace Tests;

use App\Exceptions\InvalidSignatureException;
use App\Libraries\Payments\PaymentProcessorException;
use App\Libraries\Payments\PaymentSignature;
use App\Libraries\Payments\XsollaPaymentProcessor;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Config;
use TestCase;

class XsollaPaymentProcessorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Config::set('payments.xsolla.api_key', 'api_key');
        $this->order = factory(Order::class)->states('checkout')->create();
    }

    public function testWhenEverythingIsFine()
    {
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());
        $subject->run();

        $this->assertTrue($subject->validationErrors()->isEmpty());
    }

    public function testWhenPaymentIsInsufficient()
    {
        $orderItem = factory(OrderItem::class, 'supporter_tag')->create(['order_id' => $this->order->order_id]);

        $params = $this->getTestParams([
            'purchase' => [
                'checkout' => [
                    'currency' => 'USD',
                    'amount' => $orderItem->cost - 1,
                ],
            ],
        ]);
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        // want to examine the contents of validationErrors
        $thrown = $this->runSubject($subject);

        $errors = $subject->validationErrors()->all();
        $this->assertTrue($thrown);
        $this->assertArrayHasKey('purchase.checkout.amount', $errors);
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

        $thrown = $this->runSubject($subject);

        $errors = $subject->validationErrors()->all();
        $this->assertTrue($thrown);
        $this->assertArrayHasKey('order', $errors);
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

        $thrown = $this->runSubject($subject);

        $errors = $subject->validationErrors()->all();
        $this->assertTrue($thrown);
        $this->assertArrayHasKey('order', $errors);
    }

    public function testWhenSignatureInvalid()
    {
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->invalidSignature());

        $this->expectException(InvalidSignatureException::class);
        $this->runSubject($subject);
    }

    public function testWhenOrderProcessingState()
    {
        $this->order = factory(Order::class)->states('processing')->create();
        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());
        $subject->run();

        $this->assertTrue($subject->validationErrors()->isEmpty());
    }

    public function testWhenOrderHasPhysicalItems()
    {
        $orderItem = factory(OrderItem::class)->create(['order_id' => $this->order->order_id]);

        $params = $this->getTestParams();
        $subject = new XsollaPaymentProcessor($params, $this->validSignature());

        // want to examine the contents of validationErrors
        $thrown = $this->runSubject($subject);

        $errors = $subject->validationErrors()->all();
        $this->assertTrue($thrown);
        $this->assertArrayHasKey('order.items', $errors);
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

    // wrapper to catch the exception
    // so that the contents of validationErrors can be examined.
    private function runSubject($subject)
    {
        try {
            $subject->run();
        } catch (PaymentProcessorException $e) {
            return true;
        }

        return false;
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

    private function invalidSignature()
    {
        return new class implements PaymentSignature {
            public function isValid()
            {
                return false;
            }
        };
    }
}
