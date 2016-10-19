<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Transformers\UserTransformer;

class UsersController extends Controller
{
    public function show($user_id)
    {
        return $this->showUser(User::findOrFail($user_id));
    }

    public function me()
    {
        return $this->showUser(Auth::user());
    }

    private function showUser($user)
    {
        return json_item(
            $user,
            new UserTransformer(),
            'defaultStatistics'
        );
    }
}
