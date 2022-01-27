<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\UpdateUserFollowerCountCache;
use App\Models\User;
use App\Models\UserRelation;
use Auth;
use Request;

class BlocksController extends Controller
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

        return parent::__construct();
    }

    public function store()
    {
        $currentUser = Auth::user();

        if ($currentUser->blocks()->count() >= $currentUser->maxBlocks()) {
            return error_popup(osu_trans('users.blocks.too_many'));
        }

        $targetId = get_int(Request::input('target'));
        $targetUser = User::lookup($targetId, 'id');

        if (!$targetUser) {
            abort(404);
        }

        $existingRelation = $currentUser
            ->relations()
            ->where('zebra_id', $targetId)
            ->first();

        if ($existingRelation) {
            $existingRelation->update([
                'foe' => true,
                'friend' => false,
            ]);

            // users get unfollowed when blocked, so update follower count
            dispatch(new UpdateUserFollowerCountCache($targetId));
        } else {
            UserRelation::create([
                'user_id' => $currentUser->user_id,
                'zebra_id' => $targetId,
                'foe' => true,
            ]);
        }

        return json_collection(
            $currentUser->relations()->visible()->get(),
            'UserRelation'
        );
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $block = $user->blocks()
            ->where('zebra_id', $id)
            ->first();

        if (!$block) {
            abort(404, osu_trans('users.blocks.not_blocked'));
        }

        $user->blocks()->detach($block);

        return json_collection(
            $user->relations()->visible()->get(),
            'UserRelation'
        );
    }
}
