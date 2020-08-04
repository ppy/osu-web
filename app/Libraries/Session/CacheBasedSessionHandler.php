<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Session;

use Illuminate\Session\CacheBasedSessionHandler as SessionHandlerBase;

class CacheBasedSessionHandler extends SessionHandlerBase
{
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
    }
}
