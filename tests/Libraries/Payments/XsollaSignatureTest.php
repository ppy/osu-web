<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Payments;

use App\Libraries\Payments\XsollaSignature;
use Config;
use Tests\TestCase;

class XsollaSignatureTest extends TestCase
{
    public function testCalculateSignature()
    {
        static $expected = 'e61077e203eb692b6eb29fff47ccec989089118f';
        $signature = XsollaSignature::calculateSignature("{'notification_type':'payment'}");

        $this->assertSame($expected, $signature);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('payments.xsolla.secret_key', 'magic');
    }
}
