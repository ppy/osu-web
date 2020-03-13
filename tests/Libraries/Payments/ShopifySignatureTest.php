<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\ShopifySignature;
use Config;
use Tests\TestCase;

class ShopifySignatureTest extends TestCase
{
    public function testCalculateSignature()
    {
        static $expected = 'Syw+KdQu/p0kqe9g2ttEdLFCRDb13IKygoZhQO4KO1w=';
        $signature = ShopifySignature::calculateSignature(file_get_contents(__DIR__.'/content.json'));

        $this->assertSame($expected, $signature);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('payments.shopify.webhook_key', 'magic');
    }
}
