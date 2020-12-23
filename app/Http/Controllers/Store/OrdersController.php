<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use Auth;

class OrdersController extends Controller
{
    protected $layout = 'master';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function destroy($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        $order->cancel(auth()->user());

        return response(null, 204);
    }

    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->orderBy('order_id', 'desc')
            ->with('items.product');

        if (request('type') === 'processing') {
            $orders->where('status', 'processing');
        } else {
            $orders->where('status', '<>', 'incart');
        }

        $orders = $orders->paginate(20);

        return ext_view('store.orders.index', compact('orders'));
    }
}
