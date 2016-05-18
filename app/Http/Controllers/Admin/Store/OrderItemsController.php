<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Admin\Controller;
use App\Models\Store;
use Request;

class OrderItemsController extends Controller
{
    protected $section = 'storeAdmin';

    public function update($orderId, $orderItemId)
    {
        $item = Store\OrderItem::findOrFail($orderItemId);

        if ($item->order_id !== $orderId) {
            return error_popup('invalid order id for this item.');
        }

        if ($item->order->status !== 'paid') {
            return error_popup("order status {$item->order->status} is invalid.");
        }

        $item->unguard();
        $item->update(Request::input('item'));
        $item->save();

        return ['message' => "order item {$orderItemId} updated"];
    }
}
