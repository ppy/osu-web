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

use App\Libraries\OrderCheckout;
use Request;

class CartController extends Controller
{
    protected $layout = 'master';
    protected $actionPrefix = 'cart-';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'store',
        ]]);

        $this->middleware('check-user-restricted', ['only' => [
            'store',
        ]]);

        return parent::__construct();
    }

    public function show()
    {
        if ($this->hasPendingCheckout()) {
            return ujs_redirect(route('store.checkout.show'));
        }

        $order = $this->userCart();

        if ($order !== null) {
            $checkout = new OrderCheckout($order);
            $validationErrors = $checkout->validate();
        } else {
            $validationErrors = [];
        }

        return view('store.cart', compact('order', 'validationErrors'));
    }

    public function store()
    {
        $error = $this->userCart()->updateItem(Request::input('item', []));

        if ($error === null) {
            return js_view('layout.ujs-reload');
        } else {
            return error_popup($error);
        }
    }
}
