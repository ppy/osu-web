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

use App\Models\Store\Order;
use Config;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TestCase;

class XsollaPaymentProcessorTest extends TestCase
{
    use DatabaseTransactions;

    protected $connectionsToTransact = [
        'mysql',
        'mysql-store',
    ];

    public function setUp()
    {
        parent::setUp();
        Config::set('payments.xsolla.secret_key', 'magic');
        $this->order = factory(Order::class)->states('checkout')->create();
    }

    public function testSignatureIsValid()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            $this->getPostData(),
            ['HTTP_Authorization' => 'Signature 563986f8dd0fe7b1637a43fd71e9cf4bfb8338f1']
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

    private function getPostData()
    {
        static $base = [
            'notification_type' => 'payment',
            'nothing' => 'to see',
        ];
        $order = $this->order;
        $user = $order->user;

        return array_merge($base, [
            'transaction' => [
                'external_id' => "test-{$user->user_id}-{$order->order_id}",
            ],
        ]);
    }
}
