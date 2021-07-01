<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $orderItem = factory(OrderItem::class)->states('supporter_tag')->create(['order_id' => $this->order->order_id]);

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
