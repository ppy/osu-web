<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Store;
use Auth;
use Request;
use Validator;

class StoreController extends Controller
{
    // bootstrap setup in BaseController
    protected $layout = 'master';

    // Section display for the menu at the top
    protected $section = 'store';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'getInvoice',
            'postUpdateCart',
            'postAddToCart',
            'postCheckout',
            'postNewAddress',
            'postUpdateAddress',
            'postUpdateCart',
        ]]);

        $this->middleware('App\Http\Middleware\CheckUserRestricted', ['only' => [
            'getInvoice',
            'postUpdateCart',
            'postAddToCart',
            'postCheckout',
            'postNewAddress',
            'postUpdateAddress',
            'postUpdateCart',
        ]]);

        return parent::__construct();
    }

    // GET /store

    public function getIndex()
    {
        return ujs_redirect('/store/listing');
    }

    public function getListing()
    {
        return view('store.index')
            ->with('skip_back_link', true)
            ->with('cart', $this->userCart())
            ->with('products', Store\Product::latest()->simplePaginate(30));
    }

    public function getInvoice($id = null)
    {
        $order = Store\Order::findOrFail($id);
        if ($order->shipping === null) {
            $order->refreshCost(true);
        }

        if (Auth::user()->user_id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $sentViaAddress = Store\Address::sender();

        return view('store.invoice')
            ->with('order', $order)
            ->with('copies', Request::input('copies', 1))
            ->with('sentViaAddress', $sentViaAddress);
    }

    public function getProduct($id = null)
    {
        $cart = $this->userCart();
        $product = Store\Product::with('masterProduct')->findOrFail($id);

        if (!$product->enabled) {
            abort(404);
        }

        return view('store.product', compact('cart', 'product'));
    }

    public function getCart($id = null)
    {
        return view('store.cart')
            ->with('order', $this->userCart());
    }

    public function getCheckout()
    {
        $order = $this->userCart();
        if (!$order->items()->exists()) {
            return ujs_redirect('/store/cart');
        }

        $addresses = Auth::user()->storeAddresses()->with('country')->get();

        $delayedShipping = Store\Order::where('orders.status', 'paid')->count() > config('osu.store.delayed_shipping_order_threshold');

        return view('store.checkout', compact('order', 'addresses', 'delayedShipping'));
    }

    public function missingMethod($parameters = [])
    {
        abort(404);
    }

    public function postUpdateCart()
    {
        $result = $this->userCart()->updateItem(Request::input('item', []));

        if ($result[0]) {
            return js_view('layout.ujs-reload');
        } else {
            return error_popup($result[1]);
        }
    }

    public function postUpdateAddress()
    {
        $address_id = (int) Request::input('id');
        $address = Store\Address::find($address_id);
        $order = $this->userCart();

        if (!$address || $address->user_id !== Auth::user()->user_id) {
            return error_popup('invalid address');
        }

        switch (Request::input('action')) {
            default:
            case 'use':
                $order->address()->associate($address);
                $order->save();

                return js_view('layout.ujs-reload');
                break;
            case 'remove':
                if ($order->address_id === $address_id) {
                    return error_popup('Address is being used for this order!');
                }

                if ($otherOrders = Store\Order::where('address_id', '=', $address_id)->first()) {
                    return error_popup('Address was used in a previous order!');
                }

                Store\Address::destroy($address_id);

                return js_view('store.address-destroy', ['address_id' => $address_id]);
                break;
        }
    }

    public function postNewAddress()
    {
        \Log::info(json_encode([
            'tag' => 'NEW_ADDRESS',
            'user_id' => Auth::user()->user_id,
            'address' => Request::input('address'),
        ]));

        $addressInput = Request::all()['address'];

        $validator = Validator::make($addressInput, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'street' => ['required', 'mixture'],
            'city' => ['required'],
            'state' => ['required'],
            'zip' => ['required', 'required'],
            'country_code' => ['required'],
            'phone' => ['required'],
        ]);

        $addressInput['user_id'] = Auth::user()->user_id;

        if ($validator->fails()) {
            return error_popup($validator->errors()->first());
        }

        $address = Store\Address::create($addressInput);
        $address->user()->associate(Auth::user());
        $address->save();

        $order = $this->userCart();
        $order->address()->associate($address);
        $order->save();

        return js_view('layout.ujs-reload');
    }

    public function postAddToCart()
    {
        $result = $this->userCart()->updateItem(Request::input('item', []), true);

        if ($result[0]) {
            return ujs_redirect('/store/cart');
        } else {
            return error_popup($result[1]);
        }
    }

    public function postCheckout()
    {
        $order = $this->userCart();

        if (!$order) {
            return response(['message' => 'cart is empty'], 422);
        }

        $order->refreshCost(true);

        if ((float) $order->getTotal() === 0.0 && Request::input('completed')) {
            file_get_contents("https://osu.ppy.sh/web/ipn.php?mc_gross=0&item_number=store-{$order->user_id}-{$order->order_id}");

            return ujs_redirect(action('StoreController@getInvoice', [$order->order_id]).'?thanks=1');
        }

        return js_view('store.order-create');
    }

    private function userCart()
    {
        if (Auth::check()) {
            return Store\Order::cart(Auth::user());
        } else {
            return new Store\Order();
        }
    }
}
