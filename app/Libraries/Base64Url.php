<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

class Base64Url
{
    public static function decode(string $value): ?string
    {
        return null_if_false(base64_decode(strtr($value, '-_', '+/'), true));
    }

    public static function encode(string $value): string
    {
        // url safe base64
        // reference: https://datatracker.ietf.org/doc/html/rfc4648#section-5
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }
}
