<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Libraries\Session\Store as SessionStore;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');

        parent::__construct();
    }

    public function destroy($id)
    {
        if (\Session::getId() === $id) {
            // current session
            logout();
        } else {
            $session = SessionStore::findOrNew($id);
            if ($session->userId() === \Auth::user()->getKey()) {
                $session->delete();
            } else {
                abort(404);
            }
        }

        return response()->noContent();
    }
}
