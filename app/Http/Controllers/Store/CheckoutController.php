<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Libraries\CheckoutHelper;
use Auth;
use Request;

class CheckoutController extends Controller
{
    protected $layout = 'master';


    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'store',
        ]]);

        $this->middleware('check-user-restricted', ['only' => [
            'store',
        ]]);

        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function index()
    {
        $order = $this->userCart();
        if (!$order->items()->exists()) {
            return ujs_redirect('/store/cart');
        }

        $checkout = new CheckoutHelper($order);
        $addresses = Auth::user()->storeAddresses()->with('country')->get();

        return view('store.checkout', compact('order', 'addresses', 'checkout'));
    }

    public function store()
    {
        $order = $this->userCart();

        if ($order->items()->count() === 0) {
            return error_popup('cart is empty');
        }

        if ((float) $order->getTotal() === 0.0 && Request::input('completed')) {
            file_get_contents("https://osu.ppy.sh/web/ipn.php?mc_gross=0&item_number=store-{$order->user_id}-{$order->order_id}");

            return ujs_redirect(action('StoreController@getInvoice', [$order->order_id]).'?thanks=1');
        }

        $provider = Request::input('provider');
        if ($provider === 'paypal') {
            return js_view('store.order-create');
        } else {
            return response()->json(['ok']);
        }
    }
}
