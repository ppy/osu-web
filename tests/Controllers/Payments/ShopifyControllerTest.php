<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Payments;

use App\Libraries\Payments\ShopifySignature;
use App\Models\Country;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Tests\TestCase;

class ShopifyControllerTest extends TestCase
{
    private array $payload;
    private string $url;

    public function testWebhookOrdersCancelled()
    {
        $order = Order::factory()->paid()->shopify()->create();
        $payment = new Payment([
            'provider' => Order::PROVIDER_SHOPIFY,
            'transaction_id' => $order->getTransactionId(),
            'country_code' => Country::UNKNOWN,
            'paid_at' => now(),
        ]);
        $order->payments()->save($payment);
        $order->paid($payment);

        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/cancelled'])->assertStatus(204);

        $order->refresh();
        $this->assertTrue($order->isCancelled());
        $this->assertTrue(Payment::where('order_id', $order->getKey())->where('cancelled', true)->exists());
    }

    public function testWebhookOrdersCreate()
    {
        $order = Order::factory()->shopify()->paymentRequested()->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/create'])->assertStatus(204);

        $order->refresh();
        $this->assertOrderUpdateFromWebhook($order);
        $this->assertTrue($order->status === Order::STATUS_PAYMENT_APPROVED);
    }

    public function testWebhookOrdersFulfilled()
    {
        $order = Order::factory()->shopify()->paymentApproved()->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/fulfilled'])->assertStatus(204);

        $order->refresh();
        $this->assertOrderUpdateFromWebhook($order);
        $this->assertTrue($order->isShipped());
        $this->assertNotNull($order->shipped_at);
    }

    public function testWebhookOrdersPaid()
    {
        $order = Order::factory()->shopify()->paymentRequested()->create();
        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/paid'])->assertStatus(204);

        $order->refresh();
        $this->assertOrderUpdateFromWebhook($order);
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

        $this->expectCountChange(fn () => Order::withoutGlobalScopes()->count(), 0);

        $this->sendCallbackRequest()->assertStatus(204);
    }

    public function testReplacementOrdersCreatedByDuplicatingShopifyOrderShouldBeIgnored()
    {
        // Orders are already shipped when the replacement gets created.
        $order = Order::factory()->shopify()->shipped()->create();
        $oldUpdatedAt = $order->updated_at->copy();

        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
            'gateway' => 'manual',
            'payment_gateway_names' => ['manual'],
            'processing_method' => 'manual',
            'source_name' => 'shopify_draft_order',
        ]);

        $this->expectCountChange(fn () => Order::withoutGlobalScopes()->count(), 0);

        $this->sendCallbackRequest()->assertStatus(204);

        $order->refresh();
        $this->assertSame($order->status, 'shipped');
        $this->assertEquals($order->updated_at, $oldUpdatedAt);
    }


    public function testWebhookOrderUpdateEmptyParams()
    {
        $order = Order::factory()->shopify()->paymentApproved()->create([
            'reference' => 'gid://shopify/Order/123?key=foo',
            'transaction_id' => 'shopify-123',
            'shopify_url' => 'https://not-real.local?key=foo',
        ]);
        $oldParams = $order->only('reference', 'transaction_id', 'shopify_url');

        $this->setShopifyPayload([
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ]);

        $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/fulfilled'])->assertStatus(204);

        $order->refresh();
        $this->assertSame($oldParams, $order->only('reference', 'transaction_id', 'shopify_url'));
    }

    protected function setUp(): void
    {
        parent::setUp();
        config_set('payments.shopify.webhook_key', 'magic');

        $this->url = route('payments.shopify.callback');
    }

    private function assertOrderUpdateFromWebhook(Order $order)
    {
        $this->assertSame('gid://shopify/Order/123?key=foo', $order->reference);
        $this->assertSame('https://not-real.local?key=foo', $order->shopify_url);
        $this->assertSame('shopify-123', $order->transaction_id);
    }

    private function sendCallbackRequest(array $extraHeaders = [])
    {
        $validSignature = ShopifySignature::calculateSignature(json_encode($this->payload));
        $headers = array_merge(['X-Shopify-Hmac-Sha256' => $validSignature], $extraHeaders);

        return $this->json('POST', $this->url, $this->payload, $headers);
    }

    private function setShopifyPayload(array $params)
    {
        $this->payload = [
            'admin_graphql_api_id' => 'gid://shopify/Order/123',
            'order_number' => 123,
            'order_status_url' => 'https://not-real.local?key=foo',
            ...$params,
        ];
    }
}
