<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Fulfillments;

use App\Exceptions\ChangeUsernameException;
use App\Libraries\Fulfillments\FulfillmentException;
use App\Libraries\Fulfillments\UsernameChangeFulfillment;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Tests\TestCase;

class UsernameChangeFulfillmentTest extends TestCase
{
    public function testRun()
    {
        $oldUsername = $this->user->username;
        $newUsername = 'new_username';
        $orderItem = factory(OrderItem::class)->states('username_change')->create([
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
        $orderItem = factory(OrderItem::class)->states('username_change')->create([
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
        $orderItem = factory(OrderItem::class)->states('username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => 'herpderp',
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);

        $this->expectException(FulfillmentException::class);
        $fulfiller->revoke();
    }

    public function testRevokeWhenPreviousUsernameIsNull()
    {
        $orderItem = factory(OrderItem::class)->states('username_change')->create([
            'order_id' => $this->order->order_id,
            'extra_info' => $this->user->username,
        ]);

        $fulfiller = new UsernameChangeFulfillment($this->order);

        $this->expectException(ChangeUsernameException::class);
        $fulfiller->revoke();
    }

    public function testRunWhenInsuffientPaid()
    {
        $orderItem = factory(OrderItem::class)->states('username_change')->create([
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
        User::factory()->create([
            'username' => 'new_username',
            'user_lastvisit' => time(),
        ]);

        $orderItem = factory(OrderItem::class)->states('username_change')->create([
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

        $this->user = User::factory()->create(['osu_subscriptionexpiry' => now()]);
        $this->order = factory(Order::class)->states('paid')->create(['user_id' => $this->user->user_id]);
    }
}
