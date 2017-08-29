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

use App\Libraries\Payments\CentiliPaymentProcessor;
use App\Libraries\Payments\CentiliSignature;
use App\Libraries\Payments\PaymentSignature;
use App\Libraries\Payments\PaymentProcessorException;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Config;
use TestCase;

class CentiliPaymentProcessorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Config::set('payments.centili.conversion_rate', 120.00);
        $this->order = factory(Order::class)->states('checkout')->create();
    }

    private function validSignature()
    {
        return new class implements PaymentSignature
        {
            public function isValid()
            {
                return true;
            }
        };
    }

    private function invalidSignature()
    {
        return new class implements PaymentSignature
        {
            public function isValid()
            {
                return false;
            }
        };
    }

    public function testWhenEverythingIsFine()
    {
        $params = $this->getTestParams();
        $subject = new CentiliPaymentProcessor($params, $this->validSignature());
        $subject->run();

        $this->assertTrue($subject->validationErrors()->isEmpty());
    }

    public function testWhenPaymentIsInsufficient()
    {
        $orderItem = factory(OrderItem::class, 'supporter_tag')->create(['order_id' => $this->order->order_id]);

        $params = $this->getTestParams(['enduserprice' => '479.000']);
        $subject = new CentiliPaymentProcessor($params, $this->validSignature());

        // want to examine the contents of validationErrors
        $thrown = false;
        try {
            $subject->run();
        } catch (PaymentProcessorException $e) {
            $thrown = true;
        }

        $this->assertTrue($thrown);
        $this->assertTrue($subject->validationErrors()->isAny());
    }

    private function getTestParams(array $overrides = [])
    {
        $base = [
            'clientid' => $this->order->getOrderNumber(),
            'country' => 'jp',
            'enduserprice' => '480.000',
            'event_type' => 'one_off',
            'mnocode' => 'BADDOG',
            'phone' => 'test@example.org',
            'revenue' => '4.34',
            'revenuecurrency' => 'MONOPOLY',
            'service' => config('payments.centili.api_key'),
            'status' => 'success',
            'transactionid' => '111222333',
        ];

        $data = array_merge($base, $overrides);

        // Generate a fake correct signature :trollface:
        $data['sign'] = CentiliSignature::calculateSignature(CentiliSignature::stringifyInput($data));

        return $data;
    }
}
