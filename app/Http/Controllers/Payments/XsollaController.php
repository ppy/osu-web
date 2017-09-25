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
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\XsollaPaymentProcessor;
use App\Models\Store\Order;
use Auth;
use DB;
use Request;
use Xsolla\SDK\API\XsollaClient;
use Xsolla\SDK\API\PaymentUI\TokenRequest;

class XsollaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['token', 'completed']]);
        $this->middleware('check-user-restricted', ['only' => ['token', 'completed']]);
        $this->middleware('verify-user', ['only' => ['token', 'completed']]);

        return parent::__construct();
    }

    public function token()
    {
        $projectId = config('payments.xsolla.project_id');
        $user = Auth::user();
        // FIXME: use a different method?
        $order = Order::cart($user);

        if ($order === null) {
            return;
        }

        $tokenRequest = new TokenRequest($projectId, (string)$user->user_id);
        $tokenRequest
            ->setSandboxMode(true)
            ->setExternalPaymentId($order->getOrderNumber())
            ->setUserEmail($user->user_email)
            ->setUserName($user->username)
            ->setPurchase($order->getTotal(), 'USD')
            ->setCustomParameters([
                'subtotal' => $order->getSubtotal(),
                'shipping' => $order->shipping,
                'order_id' => $order['order_id'],
            ]);

        $xsollaClient = XsollaClient::factory(array(
            'merchant_id' => config('payments.xsolla.merchant_id'),
            'api_key' => config('payments.xsolla.api_key'),
        ));

        return $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);
    }

    // Called by xsolla after payment is approved by user.
    public function callback(Request $request)
    {
        $processor = XsollaPaymentProcessor::createFromRequest($request->getFacadeRoot());
        if ($processor->isSkipped()) {
            // skip user_search notification
            return response()->json();
        }

        $processor->run();

        return response()->json(['ok']);
    }

    // After user has approved payment and redirected here by xsolla
    public function completed()
    {
        $orderNumber = Request::input('foreignInvoice') ?? '';
        $orderId = Order::getOrderId($orderNumber);
        OrderCheckout::complete($orderId);

        return redirect(route('store.invoice.show', ['invoice' => $orderId, 'thanks' => 1]));
    }

    private function exceptionResponse($exception, int $status, string $code)
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $exception->getMessage(),
            ],
        ], $status);
    }

    protected function exceptionHandler($exception)
    {
        switch (true) {
            case $exception instanceof ValidationException:
                \Log::error($exception->getMessage());

                return response()->json([
                    'error' => [
                        'code' => 'INVALID',
                        'message' => 'A validation error occured while running the transaction',
                    ],
                ], 422);
            case $exception instanceof InvalidSignatureException:
                // xsolla expects INVALID_SIGNATURE
                return $this->exceptionResponse($exception, 422, 'INVALID_SIGNATURE');
        }

        return $this->exceptionResponse($exception, 500, '');
    }
}
