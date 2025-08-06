<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App;
use App\Http\Middleware\VerifyUserAlways;
use App\Libraries\LocaleMeta;
use App\Models\Log;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    }

    protected function log($params)
    {
        $params['user_id'] = Auth::user()->user_id ?? 0;
        $params['log_ip'] = Request::ip();
        $params['log_time'] = Carbon::now();

        Log::log($params);
    }

    protected function login($user)
    {
        cleanup_cookies();

        $session = \Session::instance();
        $session->flush();
        $session->regenerateToken();
        $session->put('requires_verification', VerifyUserAlways::isRequired($user));
        Auth::login($user, false);
        if ($GLOBALS['cfg']['osu']['user']['bypass_verification']) {
            $session->markVerified();
        }
        $session->migrate(true);
    }

    protected function logout()
    {
        logout();
    }

    protected function locale()
    {
        return LocaleMeta::sanitizeCode(request('locale')) ?? App::getLocale();
    }
}
