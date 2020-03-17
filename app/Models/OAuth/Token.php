<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    public function refreshToken()
    {
        return $this->hasOne(RefreshToken::class, 'access_token_id');
    }
}
