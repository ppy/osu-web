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

use App\Libraries\Payments\CentiliSignature;
use Config;
use Tests\TestCase;

class CentiliSignatureTest extends TestCase
{
    public function testStringifyInput()
    {
        // sorts params and excludes 'sign'
        static $expected = 'wyzv';
        static $params = [
            'cde' => 'z',
            'ab' => 'y',
            'sign' => 'x',
            'aa' => 'w',
            'ce' => 'v',
        ];

        $this->assertSame($expected, CentiliSignature::stringifyInput($params));
    }

    public function testCalculateSignature()
    {
        static $expected = '98b26bf9ba67820abb3cc76900c0d47fac52ca4b';
        static $params = [
            'clientid' => 'test-12345-123',
            'country' => 'jp',
            'enduserprice' => '900.000',
            'event_type' => 'one_off',
            'mnocode' => 'THEBEST',
            'phone' => 'best@example.org',
            'revenue' => '12.3456',
            'revenuecurrency' => 'USD',
            'service' => 'adc38aea0cf18391a31e83f0b8a88286',
            'sign' => '98b26bf9ba67820abb3cc76900c0d47fac52ca4b',
            'status' => 'success',
            'transactionid' => '111222333444',
        ];

        $signature = CentiliSignature::calculateSignature($params);

        $this->assertSame($expected, $signature);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('payments.centili.secret_key', 'magic');
    }
}
