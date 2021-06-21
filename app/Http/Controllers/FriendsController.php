<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\UpdateUserFollowerCountCache;
use App\Models\User;
use App\Models\UserRelation;
use App\Transformers\UserCompactTransformer;
use Auth;
use Request;

/**
 * @group Friends
 */
class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('verify-user', [
            'only' => [
                'store',
                'destroy',
            ],
        ]);

        $this->middleware('require-scopes:friends.read', ['only' => ['index']]);

        return parent::__construct();
    }

    /**
     * Get Friends
     *
     * Returns the authenticated user's friends list.
     *
     * ---
     *
     * ### Response Format
     *
     * A collection of [UserRelation](#userrelation) objects with `target` included. `target`s include `country`, `cover`, `groups`, and `support_level`.
     *
     * @response [
     *   {
     *     "target_id": 2,
     *     "relation_type": "friend",
     *     "mutual": false,
     *     "target": {
     *       "avatar_url": "https://a.ppy.sh/2?1537409912.jpeg",
     *       "country_code": "AU",
     *       "default_group": "default",
     *       "id": 2,
     *       "is_active": true,
     *       "is_bot": false,
     *       "is_deleted": false,
     *       "is_online": false,
     *       "is_supporter": true,
     *       "last_visit": "2021-06-21T06:55:47+00:00",
     *       "pm_friends_only": false,
     *       "profile_colour": "#3366FF",
     *       "username": "peppy",
     *       "country": {
     *         "code": "AU",
     *         "name": "Australia"
     *       },
     *       "cover": {
     *         "custom_url": "https://assets.ppy.sh/user-profile-covers/2/baba245ef60834b769694178f8f6d4f6166c5188c740de084656ad2b80f1eea7.jpeg",
     *         "url": "https://assets.ppy.sh/user-profile-covers/2/baba245ef60834b769694178f8f6d4f6166c5188c740de084656ad2b80f1eea7.jpeg",
     *         "id": null
     *       },
     *       "groups": [
     *         {
     *           "colour": "#0066FF",
     *           "has_listing": false,
     *           "has_playmodes": false,
     *           "id": 33,
     *           "identifier": "ppy",
     *           "is_probationary": false,
     *           "name": "ppy",
     *           "short_name": "PPY",
     *           "playmodes": null
     *         },
     *         {
     *           "colour": "#EB47D0",
     *           "has_listing": true,
     *           "has_playmodes": false,
     *           "id": 11,
     *           "identifier": "dev",
     *           "is_probationary": false,
     *           "name": "Developers",
     *           "short_name": "DEV",
     *           "playmodes": null
     *         }
     *       ],
     *       "support_level": 3
     *     }
     *   },
     *   // ...
     * ]
     */
    public function index()
    {
        if (is_api_request()) {
            return json_collection(
                auth()->user()
                    ->relations()
                    ->friends()
                    ->withMutual()
                    ->with(['target' => fn ($query) => $query->eagerloadForListing()])
                    ->get(),
                'UserRelation',
                [
                    'target',
                    'target.country',
                    'target.cover',
                    'target.groups',
                    'target.support_level',
                ],
            );
        }

        $currentUser = auth()->user();
        $currentMode = default_mode();

        $friends = $currentUser
            ->friends()
            ->with('statistics'.studly_case($currentMode))
            ->eagerloadForListing()
            ->orderBy('username', 'asc')
            ->get();

        $transformer = new UserCompactTransformer();
        $transformer->mode = $currentMode;
        $usersJson = json_collection($friends, $transformer, [
            'cover',
            'country',
            'statistics',
            'groups',
            'support_level',
        ]);

        return ext_view('friends.index', compact('usersJson'));
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
