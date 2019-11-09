<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

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
        $ip = Request::getClientIp();
        $username = trim(Request::input('username'));
        $password = Request::input('password');
        $remember = Request::input('remember') === 'yes';

        if (!present($username) || !present($password)) {
            abort(422);
        }

        $user = User::findForLogin($username);
        $authError = User::attemptLogin($user, $password, $ip);

        if ($authError === null) {
            $this->login($user, $remember);

            return [
                'header' => render_to_string('layout._header_user'),
                'header_popup' => render_to_string('layout._popup_user'),
                'user' => Auth::user()->defaultJson(),
            ];
        } else {
            return error_popup($authError);
        }
    }

    public function destroy()
    {
        if (Auth::check()) {
            $this->logout();
        }

        return [];
    }
}
