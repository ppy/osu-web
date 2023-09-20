<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Events\UserSessionEvent;
use App\Libraries\UserVerificationState;
use Closure;
use Illuminate\Http\Request;

class SetSessionVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user !== null) {
            $isVerified = UserVerificationState::fromCurrentRequest()->isDone();

            if ($isVerified) {
                $user->markSessionVerified();
            } else {
                $isRequired = VerifyUserAlways::isRequired($user);
                $session = session();
                if ($session->get('requires_verification') !== $isRequired) {
                    $session->put('requires_verification', $isRequired);
                    $session->save();
                    UserSessionEvent::newVerificationRequirementChange(
                        $user->getKey(),
                        $isRequired,
                    )->broadcast();
                }
            }
        }

        return $next($request);
    }
}
