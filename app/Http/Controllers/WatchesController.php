<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Events\UserSubscriptionChangeEvent;
use App\Exceptions\ModelNotSavedException;
use App\Models\Watch;
use Exception;

class WatchesController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'watches-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function store()
    {
        $params = $this->getParams();
        $watch = new Watch($params);

        try {
            $watch->saveOrExplode();
        } catch (Exception $e) {
            if ($e instanceof ModelNotSavedException) {
                return error_popup($e->getMessage());
            }

            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        event(new UserSubscriptionChangeEvent('add', auth()->user(), $watch));

        return response([], 204);
    }

    public function destroy()
    {
        $params = $this->getParams();
        $watch = Watch::where($params)->first();

        if ($watch !== null) {
            $watch->delete();
            event(new UserSubscriptionChangeEvent('remove', auth()->user(), $watch));
        }

        return response([], 204);
    }

    private function getParams()
    {
        $params = get_params(request(), 'watch', ['notifiable_type:string', 'notifiable_id:int', 'subtype:string']);
        $params['user_id'] = auth()->user()->getKey();

        return $params;
    }
}
