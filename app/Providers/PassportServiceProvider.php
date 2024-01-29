<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Providers;

use App\Libraries\OAuth\RefreshTokenGrant;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;

class PassportServiceProvider extends BasePassportServiceProvider
{
    /**
     * Overrides RefreshTokenGrant to copy verified attribute of the token
     */
    protected function makeRefreshTokenGrant()
    {
        $repository = $this->app->make(RefreshTokenRepository::class);

        $grant = new RefreshTokenGrant($repository);
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}
