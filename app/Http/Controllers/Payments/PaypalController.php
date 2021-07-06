<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ValidationException;
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\NotificationType;
use App\Libraries\Payments\PaypalCreatePayment;
use App\Libraries\Payments\PaypalExecutePayment;
use App\Libraries\Payments\PaypalPaymentProcessor;
use App\Libraries\Payments\PaypalSignature;
use App\Models\Store\Order;
use App\Traits\CheckoutErrorSettable;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request as HttpRequest;
use Lang;
use Log;
use PayPal\Exception\PayPalConnectionException;
use Request;

class PaypalController extends Controller
{
    use CheckoutErrorSettable;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['ipn']]);
        $this->middleware('check-user-restricted', ['except' => ['ipn']]);
        $this->middleware('verify-user', ['except' => ['ipn']]);

        return parent::__construct();
    }

    // When user has approved a payment at Paypal and is redirected back here.
    public function approved()
    {
        $paymentId = Request::input('paymentId');
        $payerId = Request::input('PayerID');
        $orderId = Request::input('order_id');

        $order = Order::where('user_id', Auth::user()->user_id)
            ->processing()
            ->findOrFail($orderId);

        try {
            $command = new PaypalExecutePayment($order, compact('paymentId', 'payerId'));
            $payment = $command->run();
            Log::debug($payment);
        } catch (PayPalConnectionException $e) {
            return $this->setAndRedirectCheckoutError($order, $this->userErrorMessage($e));
        }

        return redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    // Begin process of approving a payment.
    public function create()
    {
        $orderId = Request::input('order_id');

        $order = Order::where('user_id', Auth::user()->user_id)->processing()->findOrFail($orderId);
        $command = new PaypalCreatePayment($order);
        $link = $command->getApprovalLink();
        // getId() is only available after the payment is created which getApprovalLink() calls.
        $order->update(['reference' => $command->getPayment()->getId()]);

        return $link;
    }

    // Payment declined by user.
    public function declined()
    {
        $orderId = Request::input('order_id');

        $order = Order::where('user_id', Auth::user()->user_id)->processing()->find($orderId);

        if ($order === null) {
            return ujs_redirect(route('store.cart.show'));
        }

        (new OrderCheckout($order, Order::PROVIDER_PAYPAL))->failCheckout();

        return $this->setAndRedirectCheckoutError($order, osu_trans('store.checkout.declined'));
    }

    // Called by Paypal.
    public function ipn(HttpRequest $request)
    {
        $params = static::extractParams($request);
        $signature = new PaypalSignature($request);
        $processor = new PaypalPaymentProcessor($params, $signature);

        try {
            $processor->run();
        } catch (ValidationException $exception) {
            Log::error($exception->getMessage());

            return response(['message' => 'A validation error occured while running the transaction'], 406);
        } catch (InvalidSignatureException $exception) {
            return response(['message' => $exception->getMessage()], 406);
        } catch (QueryException $exception) {
            // can get multiple cancellations for the same order from paypal.
            if (
                is_sql_unique_exception($exception)
                && $processor->getNotificationType() === NotificationType::REFUND
            ) {
                return 'ok';
            }

            throw $exception;
        }

        return 'ok';
    }

    private function userErrorMessage($e)
    {
        $json = json_decode($e->getData());
        $key = 'paypal/errors.'.strtolower($json->name ?? 'unknown');
        if (!Lang::has($key)) {
            $key = 'paypal/errors.unknown';
        }

        return osu_trans($key);
    }
}
