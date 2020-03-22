<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Models\Log;

class LogsController extends Controller
{
    public function index()
    {
        return ext_view('admin.logs.index', [
            'logs' => Log::orderBy('log_id', 'desc')->limit(10),
        ]);
    }
}
