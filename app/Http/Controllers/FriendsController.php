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

use App\Jobs\UpdateUserFollowerCountCache;
use App\Models\User;
use App\Models\UserRelation;
use Auth;
use Request;

class FriendsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'friends-';

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('verify-user', [
            'only' => [
                'store',
                'destroy',
            ],
        ]);

        return parent::__construct();
    }

    public function index()
    {
        $friends = Auth::user()
            ->friends()
            ->with([
                'userProfileCustomization',
                'country',
            ])
            ->orderBy('username', 'asc')
            ->get();

        if (is_api_request()) {
            return json_collection($friends, 'UserCompact', ['cover', 'country']);
        } else {
            $userlist = group_users_by_online_state($friends);

            return view('friends.index', compact('userlist'));
        }
    }

    public function store()
    {
        $currentUser = Auth::user();
        $friends = $currentUser->friends(); // don't fetch (avoids potentially instantiating 500+ friend objects)

        if ($friends->count() >= $currentUser->maxFriends()) {
            return error_popup(trans('friends.too_many'));
        }

        $targetId = get_int(Request::input('target'));
        $targetUser = User::lookup($targetId, 'id');

        if (!$targetUser) {
            abort(404);
        }

        $alreadyFriends = $friends
            ->where('user_id', $targetId)
            ->exists();

        if (!$alreadyFriends) {
            UserRelation::create([
                'user_id' => $currentUser->user_id,
                'zebra_id' => $targetId,
                'friend' => 1,
            ]);

            dispatch(new UpdateUserFollowerCountCache($targetId));
        }

        return json_collection(
            $currentUser->relations()->friends()->withMutual()->get(),
            'UserRelation'
        );
    }

    public function destroy($id)
    {
        $friend = Auth::user()
            ->friends()
            ->where(['user_id' => $id])
            ->firstOrFail();

        UserRelation::where([
            'user_id' => Auth::user()->user_id,
            'zebra_id' => $id,
            'friend' => 1,
        ])->delete();

        dispatch(new UpdateUserFollowerCountCache($id));

        return json_collection(
            Auth::user()->relations()->friends()->withMutual()->get(),
            'UserRelation'
        );
    }
}
