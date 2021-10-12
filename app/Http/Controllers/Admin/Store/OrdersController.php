<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Admin\Controller;
use App\Models\Store\Order;
use Request;

class OrdersController extends Controller
{
    public function index()
    {
        return $this->show();
    }

    public function show($orderId = null)
    {
        $orders = Order::with('user', 'address', 'address.country', 'items.product');

        if ($orderId) {
            $orders->where('orders.order_id', $orderId);
        } else {
            $orders->where('orders.status', 'paid');
        }

        $ordersItemsQuantities = $orders->itemsQuantities();

        $orders = $orders->orderBy('paid_at', 'asc')->get();

        $productId = (int) Request::input('product');
        if ($productId) {
            $orders = $orders->filter(function ($order) use ($productId) {
                return $order->items()->where('product_id', $productId)->exists();
            });
        }

        return ext_view('admin.store.orders.show', compact('orders', 'ordersItemsQuantities'));
    }

    public function ship()
    {
        $order = Order::where('status', 'paid')
            ->where('tracking_code', 'like', 'EJ%')
            ->get();

        foreach ($order as $o) {
            $o->status = Order::STATUS_SHIPPED;
            $o->save();
        }

        return ujs_redirect(route('admin.store.orders.index'));
    }

    public function update($id)
    {
        $order = Order::findOrFail($id);

        if (!$order->isPaid()) {
            return error_popup("order status {$order->status} is invalid.");
        }

        $order->unguard();
        $order->update(Request::input('order'));
        $order->save();

        return ['message' => "order {$id} updated"];
    }
}
