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

use App;
use App\Libraries\LocaleMeta;
use App\Models\Log;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Request;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Set up CSRF Protection and Authentication Beta filters.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('currentSection', $this->section ?? '');
        view()->share('currentAction', ($this->actionPrefix ?? '').current_action());
    }

    protected function formatValidationErrors(Validator $validator)
    {
        return ['validation_error' => $validator->errors()->getMessages()];
    }

    protected function log($params)
    {
        $params['user_id'] = Auth::user()->user_id ?? 0;
        $params['log_ip'] = Request::ip();
        $params['log_time'] = Carbon::now();

        Log::log($params);
    }

    protected function login($user, $remember = false)
    {
        Request::session()->flush();
        Auth::login($user, $remember);
        Request::session()->migrate(true, Auth::user()->user_id);
    }

    protected function logout()
    {
        Auth::logout();

        // FIXME: Temporarily here for cross-site login, nuke after old site is... nuked.
        unset($_COOKIE['phpbb3_2cjk5_sid']);
        unset($_COOKIE['phpbb3_2cjk5_sid_check']);
        setcookie('phpbb3_2cjk5_sid', '', 1, '/', '.ppy.sh');
        setcookie('phpbb3_2cjk5_sid_check', '', 1, '/', '.ppy.sh');
        setcookie('phpbb3_2cjk5_sid', '', 1, '/', '.osu.ppy.sh');
        setcookie('phpbb3_2cjk5_sid_check', '', 1, '/', '.osu.ppy.sh');

        Request::session()->invalidate();
    }

    protected function locale()
    {
        return LocaleMeta::sanitizeCode(request('locale')) ?? App::getLocale();
    }
}
