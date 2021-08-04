<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Store\Order;
use Auth;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
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

    protected function isAllowRestrictedUsers()
    {
        return config('store.allow_restricted_users');
    }
}
