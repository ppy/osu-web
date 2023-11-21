<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\UserVerificationLink;
use Tests\TestCase;

class UserVerificationLinkTest extends TestCase
{
    public function testIsValid(): void
    {
        $this->assertTrue(UserVerificationLink::isValid(UserVerificationLink::create()));
    }

    /**
     * @dataProvider dataProviderForTestIsValidInvalid
     */
    public function testIsValidInvalid(string $value): void
    {
        $this->assertFalse(UserVerificationLink::isValid($value));
    }

    public function dataProviderForTestIsValidInvalid(): array
    {
        return [
            ['invalid'],
            [''],
            [base64url_encode('')],
        ];
    }
}
