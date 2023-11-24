<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries;

use App\Libraries\SignedRandomString;
use Tests\TestCase;

class SignedRandomStringTest extends TestCase
{
    public function testIsValid(): void
    {
        $this->assertTrue(SignedRandomString::isValid(SignedRandomString::create(40)));
    }

    /**
     * @dataProvider dataProviderForTestIsValidInvalid
     */
    public function testIsValidInvalid(string $value): void
    {
        $this->assertFalse(SignedRandomString::isValid($value));
    }

    public function dataProviderForTestIsValidInvalid(): array
    {
        return [
            ['invalid'],
            [''],
            [base64url_encode('test')],
        ];
    }
}
