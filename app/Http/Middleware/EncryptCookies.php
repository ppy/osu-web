<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as EncryptCookiesBase;

class EncryptCookies extends EncryptCookiesBase
{
    protected $except = [
        'XSRF-TOKEN',
        'locale',
    ];
}
