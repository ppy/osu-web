<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class SignedRandomString
{
    public static function create(int $randomSize): string
    {
        $key = random_bytes($randomSize);
        $hmac = static::hmac($key);

        return base64url_encode($hmac.$key);
    }

    public static function isValid(string $input): bool
    {
        $bin = base64url_decode($input);
        if ($bin === null) {
            return false;
        }

        // hmac size for sha1 is 20
        $hmac = substr($bin, 0, 20);
        $key = substr($bin, 20);
        $expectedHmac = static::hmac($key);

        return hash_equals($expectedHmac, $hmac);
    }

    private static function hmac(string $key): string
    {
        return hash_hmac('sha1', $key, \Crypt::getKey(), true);
    }
}
