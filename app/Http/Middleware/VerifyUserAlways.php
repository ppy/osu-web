<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Models\User;

class VerifyUserAlways extends VerifyUser
{
    const GET_ACTION_METHODS = [
        'GET' => true,
        'HEAD' => true,
        'OPTIONS' => true,
    ];

    public static function isRequired(?User $user): bool
    {
        return $user !== null
            && (
                $GLOBALS['cfg']['osu']['user']['always_require_verification']
                || $user->isPrivileged()
                || $user->isInactive());
    }

    public function requiresVerification($request)
    {
        $method = $request->getMethod();
        $isPostAction = $GLOBALS['cfg']['osu']['user']['post_action_verification']
            ? !isset(static::GET_ACTION_METHODS[$method])
            : false;

        $isRequired = $isPostAction || $method === 'DELETE' || session()->get('requires_verification');

        return $isRequired;
    }
}
