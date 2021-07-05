<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use App\Exceptions\InvariantException;
use App\Models\Store\Order;
use App\Traits\StoreNotifiable;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpResponse;

/**
 * Creates a Paypal Payment for a store Order.
 *
 * Using the Paypal REST API for payments is a 2-phase process;
 * This class handles the creation of a payment for the user to approve.
 */
class PaypalCreatePayment
{
    use StoreNotifiable;

    public HttpResponse $response;

    public function __construct(public Order $order)
    {
        // Sanity check.
        if ($this->order->requiresShipping()) {
            throw new InvariantException('Paypal is not supported for orders that require shipping.');
        }
    }

    public function getReferenceId()
    {
        return $this->response->result->id;
    }

    public function getApprovalLink(): string
    {
        $links = collect($this->response->result->links)->keyBy('rel');

        return $links['approve']->href;
    }

    public function run()
    {
        $client = new PayPalHttpClient(PaypalApiContext::environment());

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'application_context' => [
                'cancel_url' => route('payments.paypal.declined', ['order_id' => $this->order->getKey()]),
                'return_url' => route('payments.paypal.approved', ['order_id' => $this->order->getKey()]),
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'PAY_NOW',
            ],
            'intent' => 'CAPTURE',
            'purchase_units' => [$this->getPurchaseUnit()],
        ];

        $this->response = $client->execute($request);
    }

    private function getPurchaseUnit()
    {
        $orderName = $this->order->getOrderNumber();
        $orderNumber = $this->order->getOrderNumber();
        $itemTotal = [
            'currency_code' => 'USD',
            'value' => $this->order->getSubTotal(),
        ];

        return [
            'amount' => [
                'breakdown' => [
                    'item_total' => $itemTotal,
                ],
                'currency_code' => 'USD',
                'value' => $this->order->getTotal(),
            ],
            'description' => $orderName,
            'invoice_id' => $orderNumber,
            'items' => [[
                'name' => $orderName,
                'quantity' => 1,
                'unit_amount' => $itemTotal,
            ]],
            'reference_id' => $orderNumber,
        ];
    }
}
