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

use App\Http\Controllers\Controller as BaseController;
use App\Models\Store\Order;
use Auth;

abstract class Controller extends BaseController
{
    protected $section = 'store';

    /**
     * Gets the cart of the currently logged in user.
     *
     * TODO: should probably memoize this
     *
     * @return Order|null cart of the current user if logged in; null, if not logged in.
     */
    protected function userCart()
    {
        if (Auth::check()) {
            return Order::cart(Auth::user());
        }
    }

    /**
     * @return bool
     */
    protected function hasPendingCheckout()
    {
        $cart = $this->userCart();

        return $cart === null ? false : $cart->isProcessing();
    }
}
