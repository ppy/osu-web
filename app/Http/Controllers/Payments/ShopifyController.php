<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use App\Exceptions\ModelNotSavedException;
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\ShopifySignature;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Carbon\Carbon;
use Exception;
use Sentry;

class ShopifyController extends Controller
{
    private $params;

    public function callback()
    {
        $signature = new ShopifySignature(request());
        if (!$signature->isValid()) {
            throw new InvalidSignatureException();
        }

        // X-Shopify-Hmac-Sha256
        // X-Shopify-Order-Id
        // X-Shopify-Shop-Domain
        // X-Shopify-Test
        // X-Shopify-Topic

        $orderId = $this->getOrderId();
        if ($orderId === null) {
            if ($this->shouldIgnore()) {
                return response([], 204);
            }

            throw new Exception('missing orderId');
        }

        $order = Order::findOrFail($orderId);

        $type = $this->getWebookType();
        switch ($type) {
            // TODO: fixup with PaymentProcessor?
            case 'orders/cancelled':
                // FIXME: We're relying on Shopify not sending cancel multiple times otherwise this will explode.
                $order->getConnection()->transaction(function ($order) {
                    $payment = $order->payments->where('cancelled', false)->first();
                    $payment->cancel();
                    $order->cancel();
                });
            case 'orders/fulfilled':
                $order->update(['status' => 'shipped', 'shipped_at' => now()]);
                break;
            case 'orders/create':
                (new OrderCheckout($order))->completeCheckout();
                break;
            case 'orders/paid':
                $this->updateOrderPayment($order);
                break;
            default:
                Sentry::captureMessage(
                    'Received %s webhook for order %s from Shopify',
                    [$type, $orderId]
                );
                break;
        }

        return response([], 204);
    }

    private function getWebookType()
    {
        return request()->header('X-Shopify-Topic');
    }

    private function getOrderId()
    {
        // array of name-value pairs.
        $attributes = $this->getParams()['note_attributes'];

        foreach ($attributes as $attribute) {
            if ($attribute['name'] === 'orderId') {
                return get_int($attribute['value']);
            }
        }
    }

    private function getParams()
    {
        if ($this->params === null) {
            $this->params = static::extractParams(request());
        }

        return $this->params;
    }

    private function shouldIgnore()
    {
        $params = $this->getParams();

        return array_get($params, 'browser_ip') === null
            && array_get($params, 'checkout_id') === null
            && array_get($params, 'gateway') === 'manual'
            && array_get($params, 'payment_gateway_names') === ['manual']
            && array_get($params, 'processing_method') === 'manual';
    }

    private function updateOrderPayment(Order $order)
    {
        $params = $this->getParams();
        $payment = new Payment([
            'provider' => Order::PROVIDER_SHOPIFY,
            'transaction_id' => $order->getProviderReference(),
            'country_code' => array_get($params, 'billing_address.country_code'),
            'paid_at' => Carbon::parse(array_get($params, 'processed_at')),
        ]);

        if (!$order->payments()->save($payment)) {
            throw new ModelNotSavedException();
        }

        $order->paid($payment);
    }
}
