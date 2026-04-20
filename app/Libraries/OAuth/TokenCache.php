<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use App\Models\OAuth\Token;
use Cache;

class TokenCache
{
    public static function get(string $tokenId): ?Token
    {
        if (static::duration() <= 0) {
            return null;
        }

        $cached = Cache::get(static::key($tokenId));

        return $cached instanceof Token ? $cached : null;
    }

    public static function put(Token $token): void
    {
        $duration = static::duration();
        if ($duration <= 0 || !$token->exists) {
            return;
        }

        Cache::put(static::key((string) $token->getKey()), $token, $duration);
    }

    public static function forget(string|int $tokenId): void
    {
        Cache::forget(static::key((string) $tokenId));
    }

    private static function duration(): int
    {
        return $GLOBALS['cfg']['osu']['oauth']['token_cache_duration'];
    }

    private static function key(string $tokenId): string
    {
        return "oauth:tok:{$tokenId}";
    }
}
