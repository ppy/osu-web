<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Payments;

use App\Libraries\Payments\ShopifySignature;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Tests\TestCase;

class ShopifyControllerTest extends TestCase
{
    public function testWebhookOrdersCancelled()
    {
        $order = factory(Order::class, 'paid')->states('shopify')->create();
        $payment = new Payment([
            'provider' => Order::PROVIDER_SHOPIFY,
            'transaction_id' => $order->getProviderReference(),
            'country_code' => 'XX',
            'paid_at' => now(),
        ]);
        $order->payments()->save($payment);
        $order->paid($payment);

        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/cancelled']);

        $order->refresh();
        $response->assertStatus(204);

        $this->assertTrue($order->status === 'cancelled');
        $this->assertTrue(Payment::where('order_id', $order->getKey())->where('cancelled', true)->exists());
    }

    public function testWebhookOrdersCreate()
    {
        $order = factory(Order::class)->states('shopify', 'processing')->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/create']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->status === 'checkout');
    }

    public function testWebhookOrdersFulfilled()
    {
        $order = factory(Order::class)->states('shopify', 'checkout')->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/fulfilled']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->status === 'shipped');
        $this->assertNotNull($order->shipped_at);
    }

    public function testWebhookOrdersPaid()
    {
        $order = factory(Order::class)->states('shopify', 'processing')->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/paid']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->isPaidOrDelivered());
        $this->assertTrue(Payment::where('order_id', $order->getKey())->where('cancelled', false)->exists());
    }

    public function testReplacementOrdersManuallyCreatedShouldBeIgnored()
    {
        $this->setShopifyPayload([
            'note_attributes' => [],
            'gateway' => 'manual',
            'payment_gateway_names' => ['manual'],
            'processing_method' => 'manual',
        ]);

        $response = $this->sendCallbackRequest();

        $response->assertStatus(204);
        $this->assertSame(Order::withoutGlobalScopes()->count(), 0);
    }

    public function testReplacementOrdersCreatedByDuplicatingShopifyOrderShouldBeIgnored()
    {
        // Orders are already shipped when the replacement gets created.
        $order = factory(Order::class)->states('shopify', 'shipped')->create();
        $oldUpdatedAt = $order->updated_at->copy();

        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
            'gateway' => 'manual',
            'payment_gateway_names' => ['manual'],
            'processing_method' => 'manual',
            'source_name' => 'shopify_draft_order',
        ]);

        $response = $this->sendCallbackRequest();

        $order->refresh();
        $response->assertStatus(204);
        $this->assertSame($order->status, 'shipped');
        $this->assertEquals($order->updated_at, $oldUpdatedAt);
        $this->assertSame(Order::withoutGlobalScopes()->count(), 1);
    }

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('payments.shopify.webhook_key', 'magic');

        $this->url = route('payments.shopify.callback');
    }

    private function sendCallbackRequest(array $extraHeaders = [])
    {
        $validSignature = ShopifySignature::calculateSignature(json_encode($this->payload));
        $headers = array_merge(['X-Shopify-Hmac-Sha256' => $validSignature], $extraHeaders);

        return $this->json('POST', $this->url, $this->payload, $headers);
    }

    private function setShopifyPayload(array $params)
    {
        $this->payload = array_merge([
            'id' => 1,
            'order_number' => 1,
        ], $params);
    }
}
