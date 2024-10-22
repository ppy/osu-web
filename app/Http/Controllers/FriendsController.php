<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\UpdateUserFollowerCountCache;
use App\Models\User;
use App\Models\UserRelation;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserRelationTransformer;
use Auth;
use Exception;

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

        parent::__construct();
    }

    public function index()
    {
        $currentUser = auth()->user();
        $currentMode = default_mode();

        $relationFriends = $currentUser->relationFriends->sortBy('username');
        $relationFriends->load(array_map(
            fn ($userPreload) => "target.{$userPreload}",
            UserCompactTransformer::listIncludesPreload($currentMode),
        ));

        $isApi = is_api_request();

        if ($isApi && api_version() >= 20241022) {
            return json_collection($relationFriends, new UserRelationTransformer(), [
                "target:ruleset({$currentMode})",
                ...array_map(
                    fn ($userInclude) => "target.{$userInclude}",
                    UserCompactTransformer::LIST_INCLUDES,
                ),
            ]);
        }

        $friends = $relationFriends->pluck('target');
        $usersJson = json_collection(
            $friends,
            (new UserCompactTransformer())->setMode($currentMode),
            UserCompactTransformer::LIST_INCLUDES
        );

        return $isApi
            ? $usersJson
            : ext_view('friends.index', compact('usersJson'));
    }

    public function store()
    {
        $currentUser = auth()->user();

        if ($currentUser->friends()->count() >= $currentUser->maxFriends()) {
            return error_popup(osu_trans('friends.too_many'));
        }

        $targetId = get_int(request('target'));
        $targetUser = User::lookup($targetId, 'id');

        if ($targetUser === null) {
            abort(404);
        }

        if ($currentUser->getKey() === $targetId) {
            abort(422);
        }

        while (true) {
            $existingRelation = $currentUser->relations()->where('zebra_id', $targetId)->first();
            $updateCount = false;

            if ($existingRelation === null) {
                try {
                    UserRelation::create([
                        'user_id' => $currentUser->user_id,
                        'zebra_id' => $targetId,
                        'friend' => true,
                    ]);
                    $updateCount = true;
                } catch (Exception $e) {
                    if (is_sql_unique_exception($e)) {
                        // redo the loop with what should be a non-null
                        // $existingRelation on the next one
                        continue;
                    }

                    throw $e;
                }
            } elseif (!$existingRelation->friend) {
                $existingRelation->update([
                    'friend' => true,
                    'foe' => false,
                ]);
                $updateCount = true;
            }

            break;
        }

        if ($updateCount) {
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
