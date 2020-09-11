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
            'postNewAddress',
            'postUpdateAddress',
        ]]);

        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted', ['only' => [
                'getInvoice',
                'postNewAddress',
                'postUpdateAddress',
            ]]);
        }

        $this->middleware('verify-user', ['only' => [
            'getInvoice',
            'postUpdateAddress',
        ]]);

        return parent::__construct();
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

                return ext_view('layout.ujs-reload', [], 'js');
                break;
            case 'remove':
                if ($order->address_id === $address_id) {
                    return error_popup('Address is being used for this order!');
                }

                if ($otherOrders = Store\Order::where('address_id', '=', $address_id)->first()) {
                    return error_popup('Address was used in a previous order!');
                }

                Store\Address::destroy($address_id);

                return ext_view('store.address-destroy', ['address_id' => $address_id], 'js');
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

        $addressInput = get_params(request()->all(), 'address', [
            'first_name',
            'last_name',
            'street',
            'city',
            'state',
            'zip',
            'country_code',
            'phone',
        ]);

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

        return ext_view('layout.ujs-reload', [], 'js');
    }
}
