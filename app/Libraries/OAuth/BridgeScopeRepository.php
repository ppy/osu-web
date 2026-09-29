<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\OAuth;

use Laravel\Passport\Bridge\ScopeRepository as BaseScopeRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;

/**
 * Class override to skip additional check when refreshing token.
 * There's already inheritance scope check in oauth2-server's RefreshTokenGrant.
 */
class BridgeScopeRepository extends BaseScopeRepository
{
    #[\Override]
    public function finalizeScopes(
        array $scopes,
        string $grantType,
        ClientEntityInterface $clientEntity,
        ?string $userIdentifier = null,
        ?string $authCodeId = null
    ): array {
        return $grantType === 'refresh_token'
            ? $scopes
            : parent::finalizeScopes($scopes, $grantType, $clientEntity, $userIdentifier, $authCodeId);
    }
}
