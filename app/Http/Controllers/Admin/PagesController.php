<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

class PagesController extends Controller
{
    public function root()
    {
        return ext_view('admin.pages.root');
    }
}
