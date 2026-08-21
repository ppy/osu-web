<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use App\Models\OAuth\Token;
use Defuse\Crypto\Crypto;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;

class EncodeToken
{
    private const ALGORITHM = 'RS256';

    public static function decodeAccessToken(string $bearerToken): ?string
    {
        try {
            $decoded = JWT::decode($bearerToken, static::publicKey());
        } catch (\Throwable $e) {
            return null;
        }

        // basic expiration check
        return time() < $decoded->exp ? $decoded->jti : null;
    }

    public static function encodeAccessToken(Token $token): string
    {
        return JWT::encode([
            'aud' => $token->client_id,
            'exp' => $token->expires_at->timestamp,
            'iat' => $token->created_at->timestamp, // issued at
            'jti' => $token->getKey(),
            'nbf' => $token->created_at->timestamp, // valid after
            'sub' => $token->user_id,
            'scopes' => $token->scopes,
        ], static::privateKey(), static::ALGORITHM);
    }

    public static function encodeRefreshToken(RefreshToken $refreshToken, Token $accessToken): string
    {
        return Crypto::encryptWithPassword(json_encode([
            'client_id' => (string) $accessToken->client_id,
            'refresh_token_id' => $refreshToken->getKey(),
            'access_token_id' => $accessToken->getKey(),
            'scopes' => $accessToken->scopes,
            'user_id' => $accessToken->user_id,
            'expire_time' => $refreshToken->expires_at->timestamp,
        ]), \Crypt::getKey());
    }

    private static function privateKey(): string
    {
        return $GLOBALS['cfg']['passport']['private_key']
            ??= file_get_contents(Passport::keyPath('oauth-private.key'));
    }

    private static function publicKey(): Key
    {
        if (!isset($GLOBALS['cfg']['passport']['public_key_jwt'])) {
            if (!present($GLOBALS['cfg']['passport']['public_key'])) {
                $GLOBALS['cfg']['passport']['public_key'] = file_get_contents(Passport::keyPath('oauth-public.key'));
            }

            $GLOBALS['cfg']['passport']['public_key_jwt'] = new Key(
                $GLOBALS['cfg']['passport']['public_key'],
                static::ALGORITHM,
            );
        }

        return $GLOBALS['cfg']['passport']['public_key_jwt'];
    }
}
