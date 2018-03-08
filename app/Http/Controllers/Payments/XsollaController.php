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
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\XsollaPaymentProcessor;
use App\Libraries\Payments\XsollaSignature;
use App\Libraries\Payments\XsollaUserNotFoundException;
use App\Models\Store\Order;
use Auth;
use Exception;
use Illuminate\Http\Request as HttpRequest;
use Log;
use Request;
use Xsolla\SDK\API\PaymentUI\TokenRequest;
use Xsolla\SDK\API\XsollaClient;

class XsollaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['callback']]);
        $this->middleware('check-user-restricted', ['except' => ['callback']]);
        $this->middleware('verify-user', ['except' => ['callback']]);

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

        $tokenRequest = new TokenRequest($projectId, (string) $user->user_id);
        $tokenRequest
            ->setSandboxMode(config('payments.sandbox'))
            ->setExternalPaymentId($order->getOrderNumber())
            ->setUserEmail($user->user_email)
            ->setUserName($user->username)
            ->setPurchase($order->getTotal(), 'USD')
            ->setCustomParameters([
                'subtotal' => $order->getSubtotal(),
                'shipping' => $order->shipping,
                'order_id' => $order['order_id'],
            ]);

        $xsollaClient = XsollaClient::factory([
            'merchant_id' => config('payments.xsolla.merchant_id'),
            'api_key' => config('payments.xsolla.api_key'),
        ]);

        return $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);
    }

    // Called by xsolla after payment is approved by user.
    public function callback(HttpRequest $request)
    {
        $params = static::extractParams($request);
        $signature = new XsollaSignature($request);
        $processor = new XsollaPaymentProcessor($params, $signature);

        try {
            if ($processor->isSkipped()) {
                return ['ok'];
            }

            $result = $processor->run();
        } catch (ValidationException $exception) {
            Log::error($exception->getMessage());

            return $this->errorResponse(
                'A validation error occured while running the transaction',
                'INVALID',
                422
            );
        } catch (InvalidSignatureException $exception) {
            // xsolla expects INVALID_SIGNATURE
            return $this->errorResponse('The signature is invalid.', 'INVALID_SIGNATURE', 422);
        } catch (XsollaUserNotFoundException $exception) {
            return $this->errorResponse('INVALID_USER', 'INVALID_USER', 404);
        } catch (Exception $exception) {
            Log::error($exception);
            // status code needs to be a 4xx code to make Xsolla an error to the user.
            return $this->errorResponse('Something went wrong.', 'FATAL_ERROR', 422);
        }

        return $result;
    }

    // After user has approved payment and redirected here by xsolla
    public function completed()
    {
        $orderNumber = Request::input('foreignInvoice') ?? '';
        $order = OrderCheckout::for($orderNumber)->completeCheckout();

        return redirect(route('store.invoice.show', ['invoice' => $order->order_id, 'thanks' => 1]));
    }

    private function errorResponse(string $message, string $code, int $status)
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ], $status);
    }
}
