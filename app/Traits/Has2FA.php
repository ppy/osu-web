<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Traits;

trait Has2FA
{
    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string  $value
     */
    public function set2faSecretAttribute(string $value)
    {
         $this->attributes['2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function get2faSecretAttribute(string $value) : string
    {
        return decrypt($value);
    }

    /**
     * Determines if a user has a 2fa secret
     *
     * @return bool
     */
    public function has2FASecret() : bool
    {
        return $this->attributes['2fa_secret'] != null;
    }
}
