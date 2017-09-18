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

use App\Events\Fulfillment\ProcessorValidationFailed;
use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Libraries\Payments\PaypalCreatePayment;
use App\Libraries\Payments\PaypalExecutePayment;
use App\Libraries\Payments\PaypalPaymentProcessor;
use App\Models\Store\Order;
use Auth;
use Request;

class PaypalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['approved', 'create']]);
        $this->middleware('check-user-restricted', ['only' => ['approved', 'create']]);
        $this->middleware('verify-user', ['only' => ['approved', 'create']]);

        return parent::__construct();
    }

    public function approved()
    {
        $paymentId = Request::input('paymentId');
        $payerId = Request::input('PayerID');
        $orderId = Request::input('order_id');

        $order = Order::where('user_id', Auth::user()->user_id)
            ->where('status', 'incart')
            ->findOrFail($orderId);

        $command = new PaypalExecutePayment($order, compact('paymentId', 'payerId'));
        $payment = $command->run();

        return redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    public function create()
    {
        $orderId = presence(Request::input('order_id'));
        if ($orderId === null) {
            abort(404);
        }

        $order = Order::where('user_id', Auth::user()->user_id)->where('status', 'incart')->findOrFail($orderId);
        $command = new PaypalCreatePayment($order);
        $link = $command->getApprovalLink();

        return $link;
    }

    public function declined()
    {
        // FIXME: show a message to the user
        return redirect(route('store.checkout.index'));
    }

    public function ipn(Request $request)
    {
        $processor = PaypalPaymentProcessor::createFromRequest($request->getFacadeRoot());
        if ($processor->isSkipped()) {
            // skip user_search notification
            return '';
        }

        try {
            $processor->run();
        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return response(['message' => 'A validation error occured while running the transaction'], 406);
        } catch (InvalidSignatureException $e) {
            return response(['message' => $e->getMessage()], 406);
        }

        return 'ok';
    }
}
