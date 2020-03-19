<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ValidationException;
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\CentiliPaymentProcessor;
use App\Libraries\Payments\CentiliSignature;
use App\Models\Store\Order;
use Illuminate\Http\Request as HttpRequest;

class CentiliController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['callback']]);
        $this->middleware('check-user-restricted', ['except' => ['callback']]);
        $this->middleware('verify-user', ['except' => ['callback']]);

        parent::__construct();
    }

    public function callback(HttpRequest $request)
    {
        $params = static::extractParams($request);
        $signature = new CentiliSignature($request);
        $processor = new CentiliPaymentProcessor($params, $signature);

        try {
            $processor->run();
        } catch (ValidationException $exception) {
            \Log::error($exception->getMessage());

            return response(['message' => 'A validation error occured while running the transaction'], 406);
        } catch (InvalidSignatureException $exception) {
            return response(['message' => $exception->getMessage()], 406);
        }

        return 'ok';
    }

    public function completed()
    {
        $orderNumber = request()->input('reference') ?? '';
        $order = OrderCheckout::for($orderNumber)->completeCheckout();

        return redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    public function failed()
    {
        $order = Order::whereOrderNumber(request()->input('reference'))->firstOrFail();
        request()->session()->flash('status', 'An error occured while processing the payment.');

        return redirect(route('store.checkout.show', $order));
    }
}
