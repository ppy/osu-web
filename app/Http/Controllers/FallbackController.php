<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

class FallbackController extends Controller
{
    public function __construct()
    {
        if (is_api_request()) {
            $this->middleware('api');
        } else {
            $this->middleware('web');
        }

        parent::__construct();
    }

    public function index()
    {
        abort(404, trans('errors.missing_route'));
    }
}
