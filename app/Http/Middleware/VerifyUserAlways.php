<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Events\UserSessionEvent;
use App\Libraries\UserVerificationState;

class VerifyUserAlways extends VerifyUser
{
    public static function isRequired($user)
    {
        return $user !== null && ($user->isPrivileged() || $user->isInactive());
    }

    public function requiresVerification($request)
    {
        $user = auth()->user();

        if ($user === null) {
            return false;
        }

        if (UserVerificationState::fromCurrentRequest()->isDone()) {
            $user->markSessionVerified();
        }

        $method = $request->getMethod();
        $isPostAction = config('osu.user.post_action_verification')
            ? !in_array($method, ['GET', 'HEAD', 'OPTIONS'], true)
            : false;

        $isRequired = $isPostAction || static::isRequired($user) || $method === 'DELETE';

        if (session()->get('requires_verification') !== $isRequired) {
            session()->put('requires_verification', $isRequired);
            session()->save();
            UserSessionEvent::newVerificationRequirementChange($user->getKey(), $isRequired)->broadcast();
        }

        return $isRequired;
    }
}
