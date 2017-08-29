<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace Tests;

use App\Libraries\Payments\CentiliSignature;
use Config;
use TestCase;

class CentiliSignatureTest extends TestCase
{
    protected $connectionsToTransact = [
        'mysql',
        'mysql-store',
    ];

    public function setUp()
    {
        parent::setUp();
        Config::set('payments.xsolla.secret_key', 'magic');
    }

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
        static $expected = '99671a633c43e7ddf409d100cfc131f4e7a2ef25';
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
            'sign' => '99671a633c43e7ddf409d100cfc131f4e7a2ef25',
            'status' => 'success',
            'transactionid' => '111222333444',
        ];

        $string = CentiliSignature::stringifyInput($params);
        $signature = CentiliSignature::calculateSignature($string);

        $this->assertSame($expected, $signature);
    }
}
