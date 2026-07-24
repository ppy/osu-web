<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

class DeviceAuth
{
    public static function authorisation(): array
    {
        $userCode = implode('-', str_split(sprintf('%09s', random_int(0, 999_999_999)), 3));
        $deviceCodeKey = bin2hex(random_bytes(32));
        $deviceCode = "{$userCode}:{$deviceCodeKey}";
        $expiresIn = 600;

        \Cache::put(static::redisKey($userCode), [
            'device_code_key' => $deviceCodeKey,
            'expires_at' => time() + $expiresIn,
        ], $expiresIn);

        return [
            'device_code' => $deviceCode,
            'expires_in' => $expiresIn,
            'interval' => 5,
            'user_code' => $userCode,
            'verification_uri' => route('device-auth'),
            'verification_uri_complete' => route('device-auth', ['user_code' => $userCode]),
        ];
    }

    public static function retrieve(?string $deviceCode): ?array
    {
        if ($deviceCode === null || strlen($deviceCode) !== 11 + 1 + 64) {
            return ['error' => 'expired_token'];
        }

        $deviceCodeKey = substr($deviceCode, 12);
        $userCode = substr($deviceCode, 0, 11);
        $key = static::redisKey($userCode);
        $data = \Cache::get($key);

        if ($data === null || !hash_equals($data['device_code_key'], $deviceCodeKey)) {
            return ['error' => 'expired_token'];
        }

        if (isset($data['user_id'])) {
            \Cache::delete($key);

            return ['user_id' => $data['user_id']];
        }

        return ['error' => 'authorization_pending'];
    }

    public static function store(?string $userCode, int $userId): bool
    {
        if ($userCode === null || strlen($userCode) !== 11) {
            return false;
        }

        $key = static::redisKey($userCode);
        $data = \Cache::get($key);
        if ($data === null) {
            return false;
        }

        $data['user_id'] = $userId;
        \Cache::put($key, $data, $data['expires_at'] - time());

        return true;
    }

    private static function redisKey(string $userCode): string
    {
        return "device_auth:{$userCode}";
    }
}
