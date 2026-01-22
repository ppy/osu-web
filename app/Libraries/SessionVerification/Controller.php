<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Exceptions\UserVerificationException;
use App\Models\LoginAttempt;

class Controller
{
    const FALLBACK_MODES = [
        'totp_gone' => [
            'messageKey' => 'user_verification.errors.totp_gone',
            'statusCode' => 422,
        ],
        'user_initiated' => [
            'messageKey' => null,
            'statusCode' => 200,
        ],
    ];

    public static function mailFallback(State $state, array $options)
    {
        $method = $state->getMethod();
        if ($method !== 'mail') {
            $state->session->setVerificationMethod('mail');
            $state->issueMail(true);
        }

        $message = $options['messageKey'] === null
            ? null
            : osu_trans($options['messageKey']);

        return is_api_request()
            ? response(['method' => $state->getMethod()], $options['statusCode'])
            : response([
                'authentication' => 'verify',
                'box' => view(
                    'users._verify_box',
                    compact('message', 'state')
                )->render(),
            ], $options['statusCode'], ['x-turbo-action' => 'session-verification-mail-fallback']);
    }

    public static function initiate()
    {
        static $statusCode = 401;

        app('route-section')->setError("{$statusCode}-verification");

        $state = State::getCurrent();
        $method = $state->getMethod();

        if ($method === 'mail') {
            $state->issueMail(true);
        }

        if (is_api_request()) {
            return response(compact('method'), $statusCode);
        }

        $request = \Request::instance();
        if ($request->ajax() || ($request->getMethod() !== 'GET' && is_turbo_request($request))) {
            return response([
                'authentication' => 'verify',
                'box' => view(
                    'users._verify_box',
                    compact('state')
                )->render(),
            ], $statusCode, ['x-turbo-action' => 'session-verification']);
        }

        return ext_view('users.verify', compact('state'), null, $statusCode);
    }

    public static function reissue()
    {
        $state = State::getCurrent();
        if ($state->session->isVerified() || $state->getMethod() !== 'mail') {
            return response(null, 422);
        }

        $state->issueMail(false);

        return response(['message' => osu_trans('user_verification.errors.reissued')], 200);
    }

    public static function verify()
    {
        $state = State::getCurrent();
        if ($state->session->isVerified()) {
            return response()->noContent();
        }

        $key = strtr(get_string(\Request::input('verification_key')) ?? '', [' ' => '']);

        try {
            if ($state->getMethod() === 'totp') {
                $totp = $state->user->userTotpKey;

                if ($totp === null) {
                    // erased between verification start and here
                    return static::mailFallback($state, static::FALLBACK_MODES['totp_gone']);
                }
                $totp->assertValidKey($key);
            } else {
                $mailState = MailState::fromSession($state->session);

                if ($mailState === null) {
                    throw new UserVerificationException('expired', true);
                }
                $mailState->verify($key);
            }
        } catch (UserVerificationException $e) {
            $reason = $e->reasonKey();
            Helper::logAttempt('input', 'fail', $reason);

            if ($reason === 'incorrect_key') {
                LoginAttempt::logAttempt(\Request::getClientIp(), $state->user, 'verify-mismatch', $key);
            }

            if ($e->shouldReissueMail()) {
                $state->issueMail(false);
            }

            throw $e;
        }

        Helper::logAttempt('input', 'success');
        $state->markVerified($mailState ?? null);

        return response()->noContent();
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
