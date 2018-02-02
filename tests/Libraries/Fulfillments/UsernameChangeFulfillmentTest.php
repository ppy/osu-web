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
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use TestCase;

class UsernameChangeFulfillmentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->order = factory(Order::class)->create(['user_id' => $this->user->user_id]);
    }

    public function testRun()
    {
        $oldUsername = $this->user->username;
        $newUsername = 'new_username';
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
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
        $this->user->saveOrExplode();

        $oldUsername = $this->user->username_previous;
        $newUsername = $this->user->username;
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
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
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
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
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => $this->user->username,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->revoke();
    }

    /**
     * @expectedException \App\Libraries\Fulfillments\FulfillmentException
     */
    public function testRunWhenInsuffientPaid()
    {
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
            'cost' => 1,
            'extra_info' => 'new_username',
        ]);

        // TODO: factory?
        $history = new UsernameChangeHistory();
        $history->user_id = $this->user->user_id;
        $history->type = 'paid';
        $history->username = $this->user->username;
        $history->saveOrExplode();

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->run();
    }

    /**
     * @expectedException \App\Libraries\Fulfillments\FulfillmentException
     */
    public function testRunWhenUsernameIsTaken()
    {
        factory(User::class)->create([
            'username' => 'new_username',
            'user_lastvisit' => time(),
        ]);

        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => 'new_username',
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);
        $fulfiller->run();
    }
}
