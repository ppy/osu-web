<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Models\Model;
use Laravel\Passport\Token;

class RefreshToken extends Model
{
    protected $table = 'oauth_refresh_tokens';

    protected $casts = ['revoked' => 'boolean'];
    protected $dates = ['expires_at'];

    public $timestamps = false;

    public function accessToken()
    {
        return $this->belongsTo(Token::class, 'access_token_id', 'id');
    }
}
