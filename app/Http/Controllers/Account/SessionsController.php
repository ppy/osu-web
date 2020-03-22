<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Auth;
use Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            abort(403);
        }

        if (Request::session()->isCurrentSession($id)) {
            // current session
            logout();
        } else {
            Request::session()->destroyUserSession($id);
        }

        return response([], 204);
    }
}
