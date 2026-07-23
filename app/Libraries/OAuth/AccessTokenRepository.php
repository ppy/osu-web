<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use App\Models\OAuth\Token;
use Laravel\Passport\Bridge\AccessTokenRepository as BaseRepository;

class AccessTokenRepository extends BaseRepository
{
    private const LOADED_TOKEN_ATTRIBUTE = 'oauth_loaded_token';

    public static function loadedToken(): ?Token
    {
        return app()->bound('request')
            ? request()->attributes->get(self::LOADED_TOKEN_ATTRIBUTE)
            : null;
    }

    public function isAccessTokenRevoked($tokenId)
    {
        $token = Token::with('client')->find($tokenId);

        if ($token === null || $token->revoked || $token->client === null || $token->client->revoked) {
            return true;
        }

        if (app()->bound('request')) {
            request()->attributes->set(self::LOADED_TOKEN_ATTRIBUTE, $token);
        }

        return false;
    }
}
