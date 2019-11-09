<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
