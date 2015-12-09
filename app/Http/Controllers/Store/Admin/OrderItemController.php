<?php

namespace App\Http\Controllers\Store\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Auth;
use Request;

class OrderItemController extends Controller
{
    protected $section = 'storeAdmin';

    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function update($orderId, $orderItemId)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $item = Store\OrderItem::findOrFail($orderItemId);

        if ($item->order_id != $orderId)
        {
            return ['error' => "invalid order id for this item"];
        }

        $item->unguard();
        $item->update(Request::input('item'));
        $item->save();

        return ['message' => "order item {$orderItemId} updated"];
    }
}
