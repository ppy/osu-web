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

namespace App\Http\Middleware;

use App\Events\UserSessionEvent;

class VerifyPrivilegedUser extends VerifyUser
{
    public static function isRequired($user)
    {
        return $user !== null && $user->isPrivileged();
    }

    public function requiresVerification($request)
    {
        $user = auth()->user();
        $isRequired = static::isRequired($user);

        if ($user !== null && session()->get('requires_verification') !== $isRequired) {
            session()->put('requires_verification', $isRequired);
            session()->save();
            event(UserSessionEvent::newVerificationRequirementChange($user->getKey(), $isRequired));
        }

        return $isRequired;
    }
}
