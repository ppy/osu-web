<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers\Admin;

use App\Models\Log;

class LogsController extends Controller
{
    protected $actionPrefix = 'logs-';

    public function index()
    {
        $logs = Log::orderBy('log_id', 'desc')->limit(10);

        return view('admin.logs.index', compact('logs'));
    }
}
