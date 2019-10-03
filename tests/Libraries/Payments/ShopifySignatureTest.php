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
