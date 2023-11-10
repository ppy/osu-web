<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Store;

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\User;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    public function testEmpty(): void
    {
        $itemCount = 3;
        $cart = Order::factory()->incart()->has(OrderItem::factory()->count($itemCount), 'items')->create();

        $this->actAsUser($cart->user, true);

        $this->expectCountChange(fn () => $cart->fresh()->items()->count(), -$itemCount);
        $this->delete(route('store.cart.empty'))->assertSuccessful();
    }

    public function testEmptyNonexistent(): void
    {
        $user = User::factory()->create();
        $this->actAsUser($user, true);

        $this->delete(route('store.cart.empty'))->assertSuccessful();
    }
}
