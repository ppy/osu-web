<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted', ['only' => [
                'store',
            ]]);
        }

        return parent::__construct();
    }

    public function show()
    {
        $order = $this->userCart();
        $validationErrors = $order !== null ? (new OrderCheckout($order))->validate() : [];

        return ext_view('store.cart.show', compact('order', 'validationErrors'));
    }

    public function store()
    {
        $add = present(request()->input('add'));
        $error = $this->userCart()->updateItem(request()->input('item', []), $add);

        if ($error === null) {
            return $add ? ujs_redirect(route('store.cart.show')) : ext_view('layout.ujs-reload', [], 'js');
        } else {
            return error_popup($error);
        }
    }
}
