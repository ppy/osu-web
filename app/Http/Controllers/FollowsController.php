<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Events\UserSubscriptionChangeEvent;
use App\Exceptions\ModelNotSavedException;
use App\Models\Follow;
use Exception;

class FollowsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'follows-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function store()
    {
        $params = $this->getParams();
        $follow = new Follow($params);

        try {
            $follow->saveOrExplode();
        } catch (Exception $e) {
            if ($e instanceof ModelNotSavedException) {
                return error_popup($e->getMessage());
            }

            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        event(new UserSubscriptionChangeEvent('add', auth()->user(), $follow));

        return response([], 204);
    }

    public function destroy()
    {
        $params = $this->getParams();
        $follow = Follow::where($params)->first();

        if ($follow !== null) {
            $follow->delete();
            event(new UserSubscriptionChangeEvent('remove', auth()->user(), $follow));
        }

        return response([], 204);
    }

    private function getParams()
    {
        $params = get_params(request(), 'follow', ['notifiable_type:string', 'notifiable_id:int', 'subtype:string']);
        $params['user_id'] = auth()->user()->getKey();

        return $params;
    }
}
