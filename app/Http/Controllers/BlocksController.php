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
            return error_popup(trans('users.blocks.too_many'));
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
            abort(404, trans('users.blocks.not_blocked'));
        }

        $user->blocks()->detach($block);

        return json_collection(
            $user->relations()->visible()->get(),
            'UserRelation'
        );
    }
}
