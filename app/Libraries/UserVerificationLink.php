<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class UserVerificationLink
{
    private const KEY_SIZE = 32;

    public static function create(): string
    {
        $key = random_bytes(static::KEY_SIZE);
        $hmac = static::hmac($key);

        return base64url_encode($key.$hmac);
    }

    public static function isValid(string $link): bool
    {
        $linkBin = base64url_decode($link);
        if ($linkBin === null) {
            return false;
        }

        $key = substr($linkBin, 0, static::KEY_SIZE);
        $hmac = substr($linkBin, static::KEY_SIZE);
        $expectedHmac = static::hmac($key);

        return hash_equals($expectedHmac, $hmac);
    }

    private static function hmac(string $key): string
    {
        return hash_hmac('sha1', $key, \Crypt::getKey(), true);
    }
}
