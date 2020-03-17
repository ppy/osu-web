<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Payments;

use Illuminate\Http\Request;

class ShopifySignature implements PaymentSignature
{
    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isValid()
    {
        $received = $this->receivedSignature();
        \Log::debug("ShopifySignature::isValidSignature calc: {$this->calculatedSignature()}, signed: {$received}");

        return $received === null
            ? false
            : hash_equals($this->calculatedSignature(), $received);
    }

    public static function calculateSignature(string $content)
    {
        return base64_encode(hash_hmac('sha256', $content, config('payments.shopify.webhook_key'), true));
    }

    private function receivedSignature()
    {
        return $this->request->header('X-Shopify-Hmac-Sha256');
    }

    private function calculatedSignature()
    {
        return static::calculateSignature($this->request->getContent());
    }
}
