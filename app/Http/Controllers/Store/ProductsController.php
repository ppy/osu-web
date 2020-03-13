<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use App\Models\Store\Product;
use Auth;

class ProductsController extends Controller
{
    protected $layout = 'master';

    public function show($id)
    {
        $product = $this->getProduct($id);
        $cart = $this->userCart();

        $requestedNotification = Auth::check()
            ? $product->notificationRequests()->where('user_id', Auth::user()->user_id)->exists()
            : false;

        return ext_view('store.products.show', compact('cart', 'product', 'requestedNotification'));
    }

    private function getProduct($id)
    {
        $product = Product::with('masterProduct')->available();

        return is_numeric($id)
            ? $product->findOrFail($id)
            : $product
                ->customClass($id)
                ->where('master_product_id', null)
                ->orderBy('product_id', 'desc')
                ->firstOrFail();
    }
}
