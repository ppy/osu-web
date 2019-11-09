<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

        if (is_api_request()) {
            $this->middleware('require-scopes:friends.read', ['only' => ['index']]);
        }

        return parent::__construct();
    }

    public function index()
    {
        $friends = Auth::user()
            ->friends()
            ->eagerloadForListing()
            ->orderBy('username', 'asc')
            ->get();

        $usersJson = json_collection($friends, 'UserCompact', ['cover', 'country', 'support_level']);

        if (is_api_request()) {
            return $usersJson;
        }

        return view('friends.index', compact('usersJson'));
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
            ->wherePivot('zebra_id', $targetId)
            ->exists();

        if (!$alreadyFriends) {
            UserRelation::create([
                'user_id' => $currentUser->user_id,
                'zebra_id' => $targetId,
                'friend' => true,
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
            ->wherePivot('zebra_id', $id)
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
