<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Admin\Controller;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Request;

class OrderItemsController extends Controller
{
    public function update($orderId, $orderItemId)
    {
        $item = OrderItem::where('order_id', $orderId)->findOrFail($orderItemId);

        if (!$item->order->isPaid()) {
            return error_popup("order status {$item->order->status} is invalid.");
        }

        $productId = get_int(Request::input('item.product_id'));
        $product = Product::findOrFail($productId);

        $item->order->switchItems($item, $product);

        return ['message' => "order item {$orderItemId} updated"];
    }
}
