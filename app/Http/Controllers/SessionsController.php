<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\User\CountryChange;
use App\Libraries\User\DatadogLoginAttempt;
use App\Libraries\User\ForceReactivation;
use App\Models\Country;
use App\Models\User;
use App\Transformers\CurrentUserTransformer;
use Auth;
use romanzipp\Turnstile\Validator as TurnstileValidator;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => [
            'store',
        ]]);

        parent::__construct();
    }

    public function store()
    {
        $request = request();

        $params = get_params($request->all(), null, ['username:string', 'password:string', 'cf-turnstile-response:string']);
        $username = presence(trim($params['username'] ?? null));
        $password = presence($params['password'] ?? null);

        if ($username === null) {
            DatadogLoginAttempt::log('missing_username');

            abort(422);
        }

        if ($password === null) {
            DatadogLoginAttempt::log('missing_password');

            abort(422);
        }

        if (captcha_login_triggered()) {
            $token = presence($params['cf-turnstile-response'] ?? null);
            $validCaptcha = false;

            if ($token !== null) {
                $validCaptcha = (new TurnstileValidator())->validate($token)->isValid();
            }

            if (!$validCaptcha) {
                if ($token === null) {
                    DatadogLoginAttempt::log('missing_captcha');
                } else {
                    DatadogLoginAttempt::log('invalid_captcha');
                }

                return $this->triggerCaptcha(osu_trans('users.login.invalid_captcha'), 422);
            }
        }

        $ip = $request->getClientIp();

        $user = User::findForLogin($username);

        if ($user === null && strpos($username, '@') !== false && !$GLOBALS['cfg']['osu']['user']['allow_email_login']) {
            $authError = osu_trans('users.login.email_login_disabled');
        } else {
            $authError = User::attemptLogin($user, $password, $ip);
        }

        if ($authError === null) {
            $forceReactivation = new ForceReactivation($user, $request);

            if ($forceReactivation->isRequired()) {
                DatadogLoginAttempt::log('password_reset');
                $forceReactivation->run();

                \Session::flash('password_reset_start', [
                    'reason' => $forceReactivation->getReason(),
                    'username' => $username,
                ]);

                return ujs_redirect(route('password-reset'));
            }

            // try fixing user country if it's currently set to unknown
            if ($user->country_acronym === Country::UNKNOWN) {
                try {
                    CountryChange::handle($user, request_country(), 'automated unknown country fixup on login');
                } catch (\Throwable $e) {
                    // report failures but continue anyway
                    log_error($e);
                }
            }

            DatadogLoginAttempt::log(null);
            $this->login($user);

            return [
                'csrf_token' => csrf_token(),
                'header' => view('layout._header_user')->render(),
                'header_popup' => view('layout._popup_user')->render(),
                'user' => json_item($user, new CurrentUserTransformer()),
            ];
        }

        if (captcha_login_triggered()) {
            return $this->triggerCaptcha($authError);
        }

        return error_popup($authError, 403);
    }

    public function destroy()
    {
        if (Auth::check()) {
            logout();
        }

        return [];
    }

    private function triggerCaptcha($message, $returnCode = 403)
    {
        return response([
            'error' => $message,
            'captcha_triggered' => true,
        ], $returnCode);
    }
}
