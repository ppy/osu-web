<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Exceptions\UserVerificationException;
use App\Models\LoginAttempt;

class Controller
{
    public static function initiate()
    {
        static $statusCode = 401;

        app('route-section')->setError("{$statusCode}-verification");

        $user = Helper::currentUserOrFail();
        $email = $user->user_email;

        $session = Helper::currentSession();
        Helper::issue($session, $user, true);

        if (is_api_request()) {
            return response(null, $statusCode);
        }

        $request = \Request::instance();
        if ($request->ajax() || ($request->getMethod() !== 'GET' && is_turbo_request($request))) {
            return response([
                'authentication' => 'verify',
                'box' => view(
                    'users._verify_box',
                    compact('email')
                )->render(),
            ], $statusCode, ['x-turbo-action' => 'session-verification']);
        }

        return ext_view('users.verify', compact('email'), null, $statusCode);
    }

    public static function reissue()
    {
        $session = Helper::currentSession();
        if ($session->isVerified()) {
            return response(null, 422);
        }

        Helper::issue($session, Helper::currentUserOrFail());

        return response(['message' => osu_trans('user_verification.errors.reissued')], 200);
    }

    public static function verify()
    {
        $session = Helper::currentSession();
        if ($session->isVerified()) {
            return response(null, 204);
        }

        $key = strtr(get_string(\Request::input('verification_key')) ?? '', [' ' => '']);
        $user = Helper::currentUserOrFail();
        $mailState = MailState::fromSession($session);

        try {
            if ($mailState === null) {
                throw new UserVerificationException('expired', true);
            }
            $mailState->verify($key);
        } catch (UserVerificationException $e) {
            Helper::logAttempt('input', 'fail', $e->reasonKey());

            if ($e->reasonKey() === 'incorrect_key') {
                LoginAttempt::logAttempt(\Request::getClientIp(), $user, 'verify-mismatch', $key);
            }

            if ($e->shouldReissue()) {
                Helper::issue($session, $user);
            }

            return error_popup($e->getMessage());
        }

        Helper::logAttempt('input', 'success');
        Helper::markVerified($session, $mailState);

        return response(null, 204);
    }

    public static function verifyLink()
    {
        $mailState = MailState::fromVerifyLink(get_string(\Request::input('key')) ?? '');

        if ($mailState === null) {
            Helper::logAttempt('link', 'fail', 'incorrect_key');

            return ext_view('accounts.verification_invalid', null, null, 404);
        }

        $session = $mailState->findSession();
        // Otherwise pretend everything is okay if session is missing
        if ($session !== null) {
            Helper::logAttempt('link', 'success');
            Helper::markVerified($session, $mailState);
        }

        return ext_view('accounts.verification_completed');
    }
}
