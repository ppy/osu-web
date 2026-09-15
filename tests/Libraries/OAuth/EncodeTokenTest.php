<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\OAuth;

use App\Libraries\OAuth\EncodeToken;
use App\Models\OAuth\Token;
use Tests\TestCase;

class EncodeTokenTest extends TestCase
{
    public function testDecodeAccessToken(): void
    {
        $token = Token::factory()->create();

        $this->assertSame(
            EncodeToken::decodeAccessToken(EncodeToken::encodeAccessToken($token)),
            $token->getKey(),
        );
    }
}
