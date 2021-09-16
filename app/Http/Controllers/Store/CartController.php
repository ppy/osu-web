<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use App\Libraries\OrderCheckout;

class CartController extends Controller
{
    protected $layout = 'master';

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
