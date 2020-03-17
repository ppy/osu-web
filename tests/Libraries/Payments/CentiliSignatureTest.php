<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
