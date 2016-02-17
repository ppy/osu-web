<?php

namespace App\Http\Controllers\Store\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Auth;
use Request;

class OrderController extends Controller
{
    protected $section = 'storeAdmin';

    public function __construct()
    {
        $this->middleware('auth');

        if (Auth::user() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return parent::__construct();
    }

    public function index()
    {
        return $this->show();
    }

    public function show($orderId = null)
    {
        $orders = Store\Order::with('user', 'address', 'address.country', 'items.product');

        if ($orderId) {
            $orders->where('orders.order_id', $orderId);
        } else {
            $orders->where('orders.status', 'paid');
        }

        $ordersItemsQuantities = Store\Order::itemsQuantities($orders);

        $orders = $orders->orderBy('created_at')->get();

        $productId = (int) Request::input('product');
        if ($productId) {
            $orders = array_where($orders, function ($_i, $order) use ($productId) {
                return $order->items()->where('product_id', $productId)->exists();
            });
        }

        return view('store.admin', compact('orders', 'ordersItemsQuantities'));
    }

    public function ship()
    {
        $order = Store\Order::where('status', 'paid')
            ->where('tracking_code', 'like', 'EJ%')
            ->get();

        foreach ($order as $o) {
            $o->status = 'shipped';
            $o->save();
        }

        return ujs_redirect(route('store.admin.orders.index'));
    }

    public function update($id)
    {
        $order = Store\Order::findOrFail($id);

        if ($order->status !== 'paid') {
            return error_popup("order status {$order->status} is invalid.");
        }

        $order->unguard();
        $order->update(Request::input('order'));
        $order->save();

        return ['message' => "order {$id} updated"];
    }
}
