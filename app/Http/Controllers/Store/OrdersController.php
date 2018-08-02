<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Http\Controllers\Store;

use App\Libraries\OrderCheckout;
use App\Models\Store\Order;
use App\Models\User;
use Auth;
use DB;
use Exception;

class OrdersController extends Controller
{
    protected $layout = 'master';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->orderBy('order_id', 'desc')
            ->with('items.product')
            ->get();

        return view('store.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->pendingCheckouts()->with('items.product')->findOrFail($id);
        if ($order->isEmpty()) {
            return ujs_redirect(route('store.cart.show'));
        }

        // TODO: should be able to notify user that items were changed due to stock/price changes.
        $order->refreshCost();
        $checkout = new OrderCheckout($order);
        $addresses = Auth::user()->storeAddresses()->with('country')->get();

        // using $errors will conflict with laravel's default magic MessageBag/ViewErrorBag that doesn't act like
        // an array and will cause issues in shared views.
        $validationErrors = session('checkout.error.errors') ?? $checkout->validate();

        return view('store.checkout', compact('order', 'addresses', 'checkout', 'validationErrors'));
    }
}
