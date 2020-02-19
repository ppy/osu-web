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

namespace App\Http\Controllers;

use App\Libraries\User\ForceReactivation;
use App\Models\User;
use Auth;
use Request;

class SessionsController extends Controller
{
    protected $section = 'user';

    public function __construct()
    {
        $this->middleware('guest', ['only' => [
            'login',
        ]]);

        return parent::__construct();
    }

    public function store()
    {
        $request = request();
        $params = get_params($request->all(), null, ['username:string', 'password:string', 'remember:bool']);
        $username = trim($params['username'] ?? null);
        $password = $params['password'] ?? null;
        $remember = $params['remember'] ?? false;

        if (!present($username) || !present($password)) {
            abort(422);
        }

        $ip = $request->getClientIp();

        $user = User::findForLogin($username);

        if ($user === null && strpos($username, '@') !== false && !config('osu.user.allow_email_login')) {
            $authError = trans('users.login.email_login_disabled');
        } else {
            $authError = User::attemptLogin($user, $password, $ip);
        }

        if ($authError === null) {
            $forceReactivation = new ForceReactivation($user, $request);

            if ($forceReactivation->isRequired()) {
                $forceReactivation->run();

                return ujs_redirect(route('password-reset'));
            }

            $this->login($user, $remember);

            return [
                'header' => view('layout._header_user')->render(),
                'header_popup' => view('layout._popup_user')->render(),
                'user' => Auth::user()->defaultJson(),
            ];
        } else {
            return error_popup($authError);
        }
    }

    public function destroy()
    {
        if (Auth::check()) {
            logout();
        }

        if (get_bool(request('redirect_home'))) {
            return ujs_redirect(route('home'));
        }

        return [];
    }
}
