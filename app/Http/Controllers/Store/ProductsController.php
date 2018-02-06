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

use App\Models\Store\Product;
use Auth;

class ProductsController extends Controller
{
    protected $layout = 'master';
    protected $actionPrefix = 'products-';

    public function show($id)
    {
        if ($this->hasPendingCheckout()) {
            return ujs_redirect(route('store.checkout.show'));
        }

        $product = $this->getProduct($id);
        $cart = $this->userCart();

        $requestedNotification = Auth::check()
            ? $product->notificationRequests()->where('user_id', Auth::user()->user_id)->exists()
            : false;

        return view('store.products.show', compact('cart', 'product', 'requestedNotification'));
    }

    private function getProduct($id)
    {
        $product = Product::with('masterProduct')->where('enabled', true);

        return is_numeric($id)
            ? $product->findOrFail($id)
            : $product
                ->customClass($id)
                ->where('master_product_id', null)
                ->orderBy('product_id', 'desc')
                ->firstOrFail();
    }
}
