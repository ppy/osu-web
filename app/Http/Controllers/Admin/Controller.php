<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Auth;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (Auth::check() && !Auth::user()->isAdmin()) {
                abort(403);
            }

            return $next($request);
        });

        return parent::__construct();
    }
}
