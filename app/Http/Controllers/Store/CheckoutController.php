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

use App\Events\Fulfillments\PaymentEvent;
use App\Libraries\OrderCheckout;
use App\Traits\CheckoutErrorSettable;
use App\Traits\StoreNotifiable;
use Auth;
use DB;
use Exception;
use Request;

class CheckoutController extends Controller
{
    use CheckoutErrorSettable, StoreNotifiable;

    protected $layout = 'master';
    protected $actionPrefix = 'checkout-';

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'store',
        ]]);

        $this->middleware('check-user-restricted', ['only' => [
            'store',
        ]]);

        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function show($id)
    {
        $order = $this->orderForCheckout($id);
        if ($order === null || $order->isEmpty()) {
            return ujs_redirect(route('store.cart.show'));
        }

        // TODO: should be able to notify user that items were changed due to stock/price changes.
        $order->refreshCost();
        $checkout = new OrderCheckout($order);
        $addresses = Auth::user()->storeAddresses()->with('country')->get();

        // using $errors will conflict with laravel's default magic MessageBag/ViewErrorBag that doesn't act like
        // an array and will cause issues in shared views.
        $validationErrors = session('checkout.error.errors') ?? $checkout->validate();

        return view('store.checkout', compact('order', 'addresses', 'checkout', 'validationErrors'));
    }

    public function store()
    {
        $orderId = get_int(request('orderId'));
        $provider = request('provider');

        $order = $this->orderForCheckout($orderId);

        if ($order === null || $order->isEmpty()) {
            return ujs_redirect(route('store.cart.show'));
        }

        $checkout = new OrderCheckout($order, $provider);

        $validationErrors = $checkout->validate();
        if (!empty($validationErrors)) {
            return $this->setAndRedirectCheckoutError(
                $order,
                trans('store.checkout.cart_problems'),
                $validationErrors
            );
        }

        $checkout->beginCheckout();

        if ((float) $order->getTotal() === 0.0 && Request::input('completed')) {
            return $this->freeCheckout($checkout);
        }

        return 'ok';
    }

    private function freeCheckout($checkout)
    {
        $order = DB::connection('mysql-store')->transaction(function () use ($checkout) {
            try {
                $order = $checkout->getOrder();
                $checkout->completeCheckout();
                $order->paid(null);
            } catch (Exception $exception) {
                $this->notifyError($exception, $order, 'store.payments.error.free');
                throw $exception;
            }

            event('store.payments.completed.free', new PaymentEvent($order));

            return $order;
        });

        return ujs_redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }
}
