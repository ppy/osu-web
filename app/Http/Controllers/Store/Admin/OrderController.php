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

        return parent::__construct();
    }

    public function index()
    {
        return $this->show();
    }

    public function show($id = null)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $orders = Store\Order::with('user', 'address', 'address.country', 'items.product');

        if ($id) {
            $orders->where('orders.order_id', $id);
        } else {
            $orders->where('orders.status', 'paid');
        }

        $ordersItemsQuantities = Store\Order::itemsQuantities($orders);
        $orders = $orders->orderBy('created_at')->get();

        return view('store.admin', compact('orders', 'ordersItemsQuantities'));
    }

    public function ship()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

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
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $order = Store\Order::findOrFail($id);
        $order->unguard();
        $order->update(Request::input('order'));
        $order->save();

        return ['message' => "order {$id} updated"];
    }
}
