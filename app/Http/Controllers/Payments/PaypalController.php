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

namespace App\Http\Controllers\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ValidationException;
use App\Libraries\Payments\PaypalCreatePayment;
use App\Libraries\Payments\PaypalExecutePayment;
use App\Libraries\Payments\PaypalPaymentProcessor;
use App\Libraries\Payments\PaypalSignature;
use App\Models\Store\Order;
use Auth;
use Illuminate\Http\Request as HttpRequest;
use Lang;
use Log;
use PayPal\Exception\PayPalConnectionException;
use Request;
use Session;

class PaypalController extends Controller
{
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
            ->where('status', 'incart')
            ->findOrFail($orderId);

        try {
            $command = new PaypalExecutePayment($order, compact('paymentId', 'payerId'));
            $payment = $command->run();
            Log::debug($payment);
        } catch (PayPalConnectionException $e) {
            Session::flash('checkout.error', $this->userErrorMessage($e));

            return redirect(route('store.checkout.index'));
        }

        return redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    // Begin process of approving a payment.
    public function create()
    {
        $orderId = Request::input('order_id');

        $order = Order::where('user_id', Auth::user()->user_id)->where('status', 'incart')->findOrFail($orderId);
        $command = new PaypalCreatePayment($order);
        $link = $command->getApprovalLink();

        return $link;
    }

    // Payment declined by user.
    public function declined()
    {
        Session::flash('checkout.error', trans('store.checkout.declined'));

        return redirect(route('store.checkout.index'));
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
        }

        return 'ok';
    }

    private function userErrorMessage($e)
    {
        $json = json_decode($e->getData());
        $name = strtolower($json->name);
        $key = Lang::has($name) ? "paypal/errors.{$name}" : 'paypal/errors.unknown';

        return trans($key);
    }
}
