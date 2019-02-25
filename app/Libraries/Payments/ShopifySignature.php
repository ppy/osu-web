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
