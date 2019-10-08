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

use App\Libraries\Payments\XsollaSignature;
use App\Models\Store\Order;
use Config;
use Tests\TestCase;

class XsollaControllerTest extends TestCase
{
    public function testWhenEverythingIsFine()
    {
        $data = $this->getPostData();
        // fake a valid signature, we only want to test if the response is working.
        $trollSignature = XsollaSignature::calculateSignature(json_encode($data));
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            $data,
            ['HTTP_Authorization' => "Signature {$trollSignature}"]
        );

        $response->assertStatus(200);
    }

    public function testValidationSignatureMissing()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            $this->getPostData()
        );

        $response->assertStatus(422);
    }

    public function testSignatureIsMalformed()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            $this->getPostData(),
            ['HTTP_Authorization' => 'Sig 1234']
        );

        $response->assertStatus(422);
    }

    public function testValidationSignatureNotMatch()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            $this->getPostData(),
            ['HTTP_Authorization' => 'Signature 9999000011112222333344445555666677778888']
        );

        $response->assertStatus(422);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('payments.xsolla.secret_key', 'magic');
        $this->order = factory(Order::class)->states('checkout')->create();
    }

    private function getPostData(array $overrides = [])
    {
        $order = $this->order;
        $user = $order->user;

        $base = [
            'notification_type' => 'payment',
            'nothing' => 'to see',
            'transaction' => [
                'id' => '12344523',
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
}
