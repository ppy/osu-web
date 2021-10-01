<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use App\Events\Fulfillments\PaymentEvent;
use App\Libraries\OrderCheckout;
use App\Traits\CheckoutErrorSettable;
use App\Traits\StoreNotifiable;
use Auth;
use DB;
use Exception;

class CheckoutController extends Controller
{
    use CheckoutErrorSettable, StoreNotifiable;

    protected $layout = 'master';

    public function __construct()
    {
        $this->middleware('auth');
        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted');
        }
        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function show($id)
    {
        $order = $this->orderForCheckout($id);
        if ($order === null || $order->isEmpty() || $order->isShouldShopify()) {
            return ujs_redirect(route('store.cart.show'));
        }

        // TODO: should be able to notify user that items were changed due to stock/price changes.
        $order->refreshCost();
        $checkout = new OrderCheckout($order);
        $addresses = Auth::user()->storeAddresses()->with('country')->get();

        // using $errors will conflict with laravel's default magic MessageBag/ViewErrorBag that doesn't act like
        // an array and will cause issues in shared views.
        $validationErrors = session('checkout.error.errors') ?? $checkout->validate();

        return ext_view('store.checkout.show', compact('order', 'addresses', 'checkout', 'validationErrors'));
    }

    public function store()
    {
        $orderId = get_int(request('orderId'));
        $provider = request('provider');
        $shopifyCheckoutId = presence(request('shopifyCheckoutId'));

        $order = $this->orderForCheckout($orderId);

        if ($order === null || $order->isEmpty()) {
            return ujs_redirect(route('store.cart.show'));
        }

        $checkout = new OrderCheckout($order, $provider, $shopifyCheckoutId);

        $validationErrors = $checkout->validate();
        if (!empty($validationErrors)) {
            return $this->setAndRedirectCheckoutError(
                $order,
                osu_trans('store.checkout.cart_problems'),
                $validationErrors
            );
        }

        $checkout->beginCheckout();

        if ((float) $order->getTotal() === 0.0) {
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

    private function orderForCheckout($id)
    {
        return Auth::user()
            ->orders()
            ->canCheckout()
            ->with('items.product')
            ->find($id);
    }
}
