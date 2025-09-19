<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use App\Models\OAuth\Token;
use League\OAuth2\Server\Grant\RefreshTokenGrant as BaseRefreshTokenGrant;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;

class RefreshTokenGrant extends BaseRefreshTokenGrant
{
    private ?array $oldRefreshToken = null;

    public function respondToAccessTokenRequest(
        ServerRequestInterface $request,
        ResponseTypeInterface $responseType,
        \DateInterval $accessTokenTTL
    ) {
        $refreshTokenData = parent::respondToAccessTokenRequest($request, $responseType, $accessTokenTTL);

        // Copy previous verification state
        $accessToken = (new \ReflectionProperty($refreshTokenData, 'accessToken'))->getValue($refreshTokenData);
        Token::where('id', $accessToken->getIdentifier())->update([
            'verified' => Token::select('verified')->find($this->oldRefreshToken['access_token_id'])?->verified ?? false,
        ]);
        $this->oldRefreshToken = null;

        return $refreshTokenData;
    }

    protected function validateOldRefreshToken(ServerRequestInterface $request, $clientId)
    {
        return $this->oldRefreshToken = parent::validateOldRefreshToken($request, $clientId);
    }
}
