<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries;

use App\Models\User;

class OneTimeKey
{
    const VALID_SECONDS = 180;

    public static function currentKey(User $user): ?string
    {
        return \Cache::get(static::lookupKey($user->getKey()));
    }

    public static function generate(User $user): string
    {
        $currentKey = static::currentKey($user);

        if ($currentKey !== null) {
            return $currentKey;
        }

        $key = bin2hex(random_bytes(4));

        \Cache::put(static::redisKey($key), [
            'user_id' => $user->getKey(),
        ], static::VALID_SECONDS);
        \Cache::put(static::lookupKey($user->getKey()), $key, static::VALID_SECONDS);

        return $key;
    }

    public static function retrieve(?string $key): ?int
    {
        if ($key === null || strlen($key) !== 8 || !ctype_xdigit($key)) {
            return null;
        }

        $redisKey = static::redisKey($key);
        $data = \Cache::get($redisKey);

        if ($data === null) {
            return null;
        }

        \Cache::delete($redisKey);
        \Cache::delete(static::lookupKey($data['user_id']));

        return $data['user_id'];
    }

    private static function lookupKey(int $userId): string
    {
        return "one_time_key_for:{$userId}";
    }

    private static function redisKey(string $key): string
    {
        return "one_time_key:{$key}";
    }
}
