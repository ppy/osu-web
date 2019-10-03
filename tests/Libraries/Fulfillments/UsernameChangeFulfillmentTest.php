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

namespace Tests\Libraries\Fulfillments;

use App\Exceptions\ChangeUsernameException;
use App\Libraries\Fulfillments\FulfillmentException;
use App\Libraries\Fulfillments\UsernameChangeFulfillment;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
use Tests\TestCase;

class UsernameChangeFulfillmentTest extends TestCase
{
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

    public function testRevokeWhenNameDoesNotMatch()
    {
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => 'herpderp',
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);

        $this->expectException(FulfillmentException::class);
        $fulfiller->revoke();
    }

    public function testRevokeWhenPreviousUsernameIsNull()
    {
        $orderItem = factory(OrderItem::class, 'username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => $this->user->username,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);

        $this->expectException(ChangeUsernameException::class);
        $fulfiller->revoke();
    }

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

        $this->expectException(FulfillmentException::class);
        $fulfiller->run();
    }

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

        $this->expectException(FulfillmentException::class);
        $fulfiller->run();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create(['osu_subscriptionexpiry' => Carbon::now()]);
        $this->order = factory(Order::class, 'paid')->create(['user_id' => $this->user->user_id]);
    }
}
