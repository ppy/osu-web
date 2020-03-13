<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
