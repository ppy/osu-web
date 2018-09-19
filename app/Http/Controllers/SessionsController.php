<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
