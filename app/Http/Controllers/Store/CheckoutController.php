<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Store;

use App\Libraries\OrderCheckout;
use App\Libraries\Payments\PaymentCompleted;
use App\Models\Store\Order;
use App\Traits\CheckoutErrorSettable;
use Auth;
use DB;

class CheckoutController extends Controller
{
    use CheckoutErrorSettable;

    protected $layout = 'master';

    public function __construct()
    {
        $this->middleware('auth');
        if (!$this->isAllowRestrictedUsers()) {
            $this->middleware('check-user-restricted');
        }
        $this->middleware('verify-user');

        parent::__construct();
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

        // using $errors will conflict with laravel's default magic MessageBag/ViewErrorBag that doesn't act like
        // an array and will cause issues in shared views.
        $validationErrors = session('checkout.error.errors') ?? $checkout->validate();

        return ext_view('store.checkout.show', compact('order', 'checkout', 'validationErrors'));
    }

    public function store()
    {
        $params = get_params(request()->all(), null, [
            'hide_from_activity:bool',
            'orderId:int',
            'provider',
            'shopifyCheckoutId',
        ], ['null_missing' => true]);

        $order = $this->orderForCheckout($params['orderId']);

        if ($order === null || $order->isEmpty()) {
            return ujs_redirect(route('store.cart.show'));
        }

        if ($params['hide_from_activity'] !== null) {
            $order->setGiftsHidden($params['hide_from_activity']);
        }

        $checkout = new OrderCheckout($order, $params['provider'], $params['shopifyCheckoutId']);

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
            $order = $checkout->getOrder();
            $checkout->completeCheckout();

            (new PaymentCompleted($order, null))->handle();

            return $order;
        });

        return ujs_redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    private function orderForCheckout($id): ?Order
    {
        return Auth::user()
            ->orders()
            ->whereCanCheckout()
            ->with('items.product')
            ->find($id);
    }
}
