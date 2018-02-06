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

    // Section display for the menu at the top
    protected $section = 'store';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'getInvoice',
            'postAddToCart',
            'postNewAddress',
            'postUpdateAddress',
        ]]);

        $this->middleware('check-user-restricted', ['only' => [
            'getInvoice',
            'postAddToCart',
            'postNewAddress',
            'postUpdateAddress',
        ]]);

        $this->middleware('verify-user', ['only' => [
            'getInvoice',
            'postUpdateAddress',
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
        if ($this->hasPendingCheckout()) {
            return ujs_redirect(route('store.checkout.show'));
        }

        return view('store.index')
            ->with('cart', $this->userCart())
            ->with('products', Store\Product::latest()->simplePaginate(30));
    }

    public function getInvoice($id = null)
    {
        $order = Store\Order::where('status', '<>', 'incart')
            ->with('items.product')
            ->findOrFail($id);

        if (Auth::user()->user_id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $sentViaAddress = Store\Address::sender();
        $forShipping = Auth::user()->isAdmin() && get_bool(Request::input('for_shipping'));
        $copies = clamp(get_int(request('copies')), 1, config('store.invoice.max_copies'));

        return view('store.invoice', compact('order', 'forShipping', 'copies', 'sentViaAddress'));
    }

    public function missingMethod($parameters = [])
    {
        abort(404);
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
            return ujs_redirect(route('store.cart.show'));
        } else {
            return error_popup($result[1]);
        }
    }
}
