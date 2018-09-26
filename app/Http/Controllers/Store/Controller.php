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

    protected $pendingCheckout;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('pendingCheckout', optional($this->pendingCheckouts())->first());

            return $next($request);
        });

        parent::__construct();
    }

    protected function orderForCheckout($id)
    {
        return Auth::user()
            ->orders()
            ->whereIn('status', ['incart', 'processing'])
            ->with('items.product')
            ->find($id);
    }

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
            return Order::cart(Auth::user()) ?? new Order(['user_id' => Auth::user()->user_id]);
        }
    }

    /**
     * Gets the pending checkouts of the current user.
     *
     * @return \Illuminate\Database\Eloquent\Builder pending checkouts of the current user.
     */
    protected function pendingCheckouts()
    {
        if (Auth::check()) {
            return Order::where('user_id', Auth::user()->getKey())->processing();
        }
    }
}
