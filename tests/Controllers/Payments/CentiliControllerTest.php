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

namespace Tests\Controllers\Payments;

use App\Libraries\Payments\CentiliSignature;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use Config;
use Tests\TestCase;

class CentiliControllerTest extends TestCase
{
    public function testWhenEverythingIsFine()
    {
        $data = $this->getPostData();

        $response = $this->call(
            'POST',
            route('payments.centili.callback'),
            $data
        );

        $response->assertStatus(200);
    }

    public function testWhenPaymentIsInsufficient()
    {
        $orderItem = factory(OrderItem::class, 'supporter_tag')->create(['order_id' => $this->order->order_id]);

        $data = $this->getPostData(['enduserprice' => '479.000']);

        $response = $this->call(
            'POST',
            route('payments.centili.callback'),
            $data
        );

        $response->assertStatus(406);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('payments.centili.secret_key', 'secret_key');
        Config::set('payments.centili.api_key', 'api_key');
        Config::set('payments.centili.conversion_rate', 120.00);
        $this->order = factory(Order::class)->states('checkout')->create();
    }

    private function getPostData(array $overrides = [])
    {
        $base = [
            'reference' => $this->order->getOrderNumber(),
            'country' => 'jp',
            'enduserprice' => $this->order->getTotal() * config('payments.centili.conversion_rate'),
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
        $data['sign'] = CentiliSignature::calculateSignature($data);

        return $data;
    }
}
