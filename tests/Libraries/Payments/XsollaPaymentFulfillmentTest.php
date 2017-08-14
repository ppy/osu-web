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

use Config;
use TestCase;

class XsollaPaymentFulfillmentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Config::set('payments.xsolla.secret_key', 'magic');
    }

    public function testSignatureIsValid()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            ['nothing' => 'to see'],
            ['HTTP_Authorization' => 'Signature b527cd6f6dac87f9abadf39d0120813125d6b460']
        );

        $response->assertStatus(200);
    }

    public function testValidationSignatureMissing()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            ['nothing' => 'to see']
        );

        $response->assertStatus(422);
    }

    public function testSignatureIsMalformed()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            ['HTTP_Authorization' => 'Sig 1234']
        );

        $response->assertStatus(422);
    }

    public function testValidationSignatureNotMatch()
    {
        $response = $this->json(
            'POST',
            route('payments.xsolla.callback'),
            ['nothing' => 'to see'],
            ['HTTP_Authorization' => 'Signature 1234']
        );

        $response->assertStatus(422);
    }
}
