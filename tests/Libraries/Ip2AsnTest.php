<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\Ip2Asn;
use Tests\TestCase;

class Ip2AsnTest extends TestCase
{
    /**
     * @dataProvider dataProviderForLookup
     */
    public function testLookup(string $ip, string $asn)
    {
        $this->assertSame((new Ip2Asn())->lookup($ip), $asn);
    }

    public function dataProviderForLookup(): array
    {
        return [
            'cloudflare 1' => ['2606:4700::6810:85e5', '13335'],
            'cloudflare 2' => ['104.16.133.229', '13335'],
            'google dns 1' => ['8.8.8.8', '15169'],
            'google dns 2' => ['8.8.4.4', '15169'],
            'google search 1' => ['2404:6800:400a:804::200e', '15169'],
            'he 1' => ['216.218.236.2', '6939'],
            'he 2' => ['2001:470:0:503::2', '6939'],
            'opendns 1' => ['2620:119:35::35', '36692'],
            'opendns 2' => ['2620:119:35::53', '36692'],
            'opendns 3' => ['2620:0:ccc::2', '36692'],
            'opendns 4' => ['2620:0:ccd::2', '36692'],
            'opendns 5' => ['208.67.222.123', '36692'],
            'opendns 6' => ['208.67.220.123', '36692'],
            'ovh 1' => ['198.27.92.15', '16276'],
            'some uni 1' => ['167.205.3.1', '4796'],
        ];
    }
}
