<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;

class NotificationController extends Controller
{
    /*
        NOTE: this file isnt meant for using in views; everything is JSON as it's a REST controller
        Dont include CSRF protection in this or you'll break bancho.
    */

    protected $auth = false;
    protected $user;

    public function __construct()
    {
        if (! Auth::check()) {
            $key = Input::server('X_BANCHO_AUTH', false) ? Input::server('X_BANCHO_AUTH') : Input::get('key', false);
            $sender = Input::server('X_BANCHO_SENDER', false) ? Input::server('X_BANCHO_SENDER') : Input::get('sender', false);

            if ($key && $sender && User::validate($sender)) {
                try {
                    $user = User::findOrFail($sender);

                    if ($user->verify($key)) {
                        $this->auth = true;
                        $this->user = $user;

                        return;
                    }
                } catch (ModelNotFoundException $e) {
                }
            }

            $this->auth = false;
        } else {
            $this->auth = true;
            $this->user = Auth::user();
        }
    }

    public function getIndex()
    {
        if ($this->auth) {
            return $this->getUser($this->user->user_id);
        } else {
            return $this->error('not authorized', 403);
        }
    }

    // /notifications/group/11/50/1

    public function getGroup($group, $limit = 20, $page = 0)
    {
        if (! $this->auth) {
            return $this->error('not authorized', 401);
        }

        if (! $this->user->isDev() or ! $this->user->isHax() or ! $this->user->isGroup($group)) {
            return $this->error('not authorized', 401);
        }

        try {
            $group = Group::findOrFail($group);

            $limit = ($limit > 50) ? 50 : $limit;

            $offset = ($page <= 0) ? 0 : ($limit * $page);

            $notifications = $group
                ->notifications()
                ->take($limit)
                ->skip($offset);

            return $this->response($notifications->get());
        } catch (ModelNotFoundException $e) {
            return $this->error('group not found', 404);
        }
    }

    public function getUser($user, $limit = 20, $page = 0)
    {
        if ($this->user->user_id != $user) {
            if (! $this->user->isHax() or ! $this->user->isDev()) {
                return $this->error('not authorized', 403);
            }
        }
        try {
            $user = User::findOrFail($user);

            $limit = ($limit > 50) ? 50 : $limit;

            $offset = ($page <= 0) ? 0 : ($limit * $page);

            $notifications = $user
                ->notifications()
                ->take($limit)
                ->skip($offset);

            return $this->response($notifications->get());
        } catch (ModelNotFoundException $e) {
            return $this - error('group not found', 404);
        }
    }

    public function missingMethod($parameters = [])
    {
        return $this->error('not found', 404);
    }

    protected function error($error, $code)
    {
        return $this->response(['error' => $error, 'code' => $code]);
    }

    protected function response($parameters = [])
    {
        $response = Response::json($parameters);

        // JSON-P
        if (Input::has('callback')) {
            $response->setCallback(Input::get('callback'));
        }

        return $response;
    }
}
