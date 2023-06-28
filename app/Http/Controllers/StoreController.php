<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Http\Controllers\Store\Controller as Controller;
use App\Models\Store;
use Auth;
use Request;
use Validator;

class StoreController extends Controller
{
    // bootstrap setup in BaseController
    protected $layout = 'master';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'getInvoice',
        ]]);

        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted', ['only' => [
                'getInvoice',
            ]]);
        }

        $this->middleware('verify-user', ['only' => [
            'getInvoice',
        ]]);

        parent::__construct();
    }

    public function getListing()
    {
        return ext_view('store.index', [
            'cart' => $this->userCart(),
            'products' => Store\Product::listing()->get(),
        ]);
    }

    public function getInvoice($id = null)
    {
        $order = Store\Order::whereHasInvoice()
            ->with('items.product')
            ->findOrFail($id);

        if (Auth::user()->user_id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $sentViaAddress = Store\Address::sender();
        $forShipping = Auth::user()->isAdmin() && get_bool(Request::input('for_shipping'));
        $copies = clamp(get_int(request('copies')), 1, config('store.invoice.max_copies'));

        return ext_view('store.invoice', compact('order', 'forShipping', 'copies', 'sentViaAddress'));
    }

    public function missingMethod($parameters = [])
    {
        abort(404);
    }
}
