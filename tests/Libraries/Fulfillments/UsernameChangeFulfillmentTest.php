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

use App\Libraries\Fulfillments\UsernameChangeFulfillment;
use App\Models\User;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TestCase;

class UsernameChangeFulfillmentTest extends TestCase
{
    use DatabaseTransactions;

    protected $connectionsToTransact = [
        'mysql',
        'mysql-store',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->product = $this->product();
        $this->user = factory(User::class)->create();
        $this->order = factory(Order::class)->create(['user_id' => $this->user->user_id]);
    }

    public function testRun()
    {
        $oldUsername = $this->user->username;
        $newUsername = 'new_username';
        $orderItem = factory(OrderItem::class)->create([
            'order_id' => $this->order->order_id,
            'product_id' => $this->product->product_id,
            'cost' => 0,
            'extra_info' => $newUsername,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->run();
        $this->user->refresh();

        $this->assertSame($newUsername, $this->user->username);
        $this->assertSame($oldUsername, $this->user->username_previous);
    }

    public function testRevoke()
    {
        $this->user->username_previous = 'old_username';
        $this->user->save();

        $oldUsername = $this->user->username_previous;
        $newUsername = $this->user->username;
        $orderItem = factory(OrderItem::class)->create([
            'order_id' => $this->order->order_id,
            'product_id' => $this->product->product_id,
            'cost' => 0,
            'extra_info' => $newUsername,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->revoke();
        $this->user->refresh();

        $this->assertSame($oldUsername, $this->user->username);
        $this->assertNull($this->user->username_previous);
    }

    /**
     * @expectedException \App\Libraries\Fulfillments\FulfillmentException
     */
    public function testRevokeWhenNameDoesNotMatch()
    {
        $orderItem = factory(OrderItem::class)->create([
            'order_id' => $this->order->order_id,
            'product_id' => $this->product->product_id,
            'cost' => 0,
            'extra_info' => 'herpderp',
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->revoke();
    }

    /**
     * @expectedException \App\Exceptions\ChangeUsernameException
     */
    public function testRevokeWhenPreviousUsernameIsNull()
    {
        $orderItem = factory(OrderItem::class)->create([
            'order_id' => $this->order->order_id,
            'product_id' => $this->product->product_id,
            'cost' => 0,
            'extra_info' => $this->user->username,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->revoke();
    }

    private function product()
    {
        return Product::customClass('username-change')->first(); // should already exist from migrations
    }
}
