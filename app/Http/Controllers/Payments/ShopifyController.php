<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Payments;

use App\Libraries\OrderCheckout;
use App\Libraries\Payments\ShopifySignature;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Carbon\Carbon;
use Log;
use Sentry\Severity;
use Sentry\State\Scope;

class ShopifyController extends Controller
{
    private $params;

    public function callback()
    {
        $signature = new ShopifySignature(request());
        $signature->assertValid();

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

        /** @var Order $order */
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
                $this->updateWithShopifyParams($order);
                $order->update(['status' => Order::STATUS_SHIPPED, 'shipped_at' => now()]);
                break;
            case 'orders/create':
                if ($order->isShipped() && $this->isDuplicateOrder()) {
                    return response([], 204);
                }

                (new OrderCheckout($order))->completeCheckout();

                $this->updateWithShopifyParams($order);

                break;
            case 'orders/paid':
                $this->updateWithShopifyParams($order);
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

    private function getShopifyParams()
    {
        $params = $this->getParams();

        $gid = $params['admin_graphql_api_id'] ?? null;
        $orderNumber = $params['order_number'] ?? null;
        $orderStatusUrl = $params['order_status_url'] ?? null;

        if ($gid === null) {
            app('sentry')->getClient()->captureMessage(
                'Missing admin_graphql_api_id in Shopify webhook.',
                new Severity(Severity::WARNING),
                (new Scope())->setExtra('order_id', $this->getOrderId())
            );
        }

        if ($orderNumber === null) {
            app('sentry')->getClient()->captureMessage(
                'Missing order_number in Shopify webhook.',
                new Severity(Severity::WARNING),
                (new Scope())->setExtra('order_id', $this->getOrderId())
            );
        }

        if ($orderStatusUrl === null) {
            app('sentry')->getClient()->captureMessage(
                'Missing order_status_url in Shopify webhook.',
                new Severity(Severity::WARNING),
                (new Scope())->setExtra('order_id', $this->getOrderId())
            );
        }

        return [$orderNumber, $gid, $orderStatusUrl];
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

        $order->paid($payment);
    }

    private function updateWithShopifyParams(Order $order)
    {
        [$orderNumber, $gid, $orderStatusUrl] = $this->getShopifyParams();

        if ($orderNumber !== null) {
            $order->setShopifyOrderNumber($orderNumber);
        }

        if ($gid !== null) {
            $order->reference = $gid;
        }

        if ($orderStatusUrl !== null) {
            $order->shopify_url = $orderStatusUrl;
        }

        $order->save();
    }
}
