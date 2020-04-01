<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }
}
