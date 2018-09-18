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

use App\Models\User;
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

        return view('store.orders.index', compact('orders'));
    }
}
