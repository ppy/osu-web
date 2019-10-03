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

namespace Tests\Controllers\Payments;

use App\Libraries\Payments\ShopifySignature;
use App\Models\Store\Order;
use App\Models\Store\Payment;
use Tests\TestCase;

class ShopifyControllerTest extends TestCase
{
    public function testWebhookOrdersIdIsRequired()
    {
        $this->payload = [
            'note_attributes' => [],
        ];

        $response = $this->sendCallbackRequest();

        $response->assertStatus(500);
    }

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

        $this->payload = [
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ];

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/cancelled']);

        $order->refresh();
        $response->assertStatus(204);

        $this->assertTrue($order->status === 'cancelled');
        $this->assertTrue(Payment::where('order_id', $order->getKey())->where('cancelled', true)->exists());
    }

    public function testWebhookOrdersCreate()
    {
        $order = factory(Order::class)->states('shopify', 'processing')->create();
        $this->payload = [
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ];

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/create']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->status === 'checkout');
    }

    public function testWebhookOrdersFulfilled()
    {
        $order = factory(Order::class)->states('shopify', 'checkout')->create();
        $this->payload = [
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ];

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/fulfilled']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->status === 'shipped');
        $this->assertNotNull($order->shipped_at);
    }

    public function testWebhookOrdersPaid()
    {
        $order = factory(Order::class)->states('shopify', 'processing')->create();
        $this->payload = [
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
        ];

        $response = $this->sendCallbackRequest(['X-Shopify-Topic' => 'orders/paid']);

        $order->refresh();
        $response->assertStatus(204);
        $this->assertTrue($order->isPaidOrDelivered());
        $this->assertTrue(Payment::where('order_id', $order->getKey())->where('cancelled', false)->exists());
    }

    public function testReplacementOrdersManuallyCreatedShouldBeIgnored()
    {
        $this->payload = [
            'note_attributes' => [],
            'gateway' => 'manual',
            'payment_gateway_names' => ['manual'],
            'processing_method' => 'manual',
        ];

        $response = $this->sendCallbackRequest();

        $response->assertStatus(204);
        $this->assertSame(Order::withoutGlobalScopes()->count(), 0);
    }

    public function testReplacementOrdersCreatedByDuplicatingShopifyOrderShouldBeIgnored()
    {
        // Orders are already shipped when the replacement gets created.
        $order = factory(Order::class)->states('shopify', 'shipped')->create();
        $oldUpdatedAt = $order->updated_at->copy();

        $this->payload = [
            'note_attributes' => [['name' => 'orderId', 'value' => $order->getKey()]],
            'gateway' => 'manual',
            'payment_gateway_names' => ['manual'],
            'processing_method' => 'manual',
            'source_name' => 'shopify_draft_order',
        ];

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
}
