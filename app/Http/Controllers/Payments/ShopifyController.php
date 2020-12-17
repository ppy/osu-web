<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Payments;

use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ModelNotSavedException;
use App\Libraries\OrderCheckout;
use App\Libraries\Payments\ShopifySignature;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Carbon\Carbon;
use Log;
use Sentry\State\Scope;

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

        $type = $this->getWebookType();
        $orderId = $this->getOrderId();

        if ($orderId === null) {
            $params = $this->getParams();
            // just log info that can be used for lookup if necessary.
            $data = [
                'shopify_gid' => $params['id'],
                'shopify_order_number' => $params['order_number'],
                'webhook_type' => $type,
            ];
            Log::info('Shopify callback with missing orderId', $data);

            return response([], 204);
        }

        $order = Order::findOrFail($orderId);

        switch ($type) {
            case 'orders/cancelled':
                // FIXME: We're relying on Shopify not sending cancel multiple times otherwise this will explode.
                $order->getConnection()->transaction(function () use ($order) {
                    $payment = $order->payments()->where('cancelled', false)->first();
                    $payment->cancel();
                    $order->cancel();
                });
                break;
            case 'orders/fulfilled':
                $order->update(['status' => 'shipped', 'shipped_at' => now()]);
                break;
            case 'orders/create':
                if ($order->status === 'shipped' && $this->isDuplicateOrder()) {
                    return response([], 204);
                }

                (new OrderCheckout($order))->completeCheckout();
                break;
            case 'orders/paid':
                $this->updateOrderPayment($order);
                break;
            default:
                app('sentry')->getClient()->captureMessage(
                    'Received unknown webhook for order from Shopify',
                    null,
                    (new Scope())
                        ->setExtra('type', $type)
                        ->setExtra('order_id', $orderId)
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

    /**
     * Replacement orders created at the Shopify end by duplicating? the previous order.
     *
     * @return bool
     */
    private function isDuplicateOrder()
    {
        $params = $this->getParams();

        return $params['source_name'] === 'shopify_draft_order' && $this->isManualOrder();
    }

    /**
     * Manually created replacement orders created at the Shopify end that might not have
     * the orderId included.
     *
     * @return bool
     */
    private function isManualOrder()
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
