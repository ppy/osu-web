<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserGroupsController extends Controller
{
    public function update($userId, $groupId)
    {
        User::findOrFail($userId)->addToGroup(
            app('groups')->byIdOrFail($groupId),
            get_arr(request()->input('playmodes'), 'get_string'),
        );

        return response(null, 204);
    }

    public function destroy($userId, $groupId)
    {
        User::findOrFail($userId)->removeFromGroup(
            app('groups')->byIdOrFail($groupId),
        );

        return response(null, 204);
    }

    public function setDefault($userId, $groupId)
    {
        User::findOrFail($userId)->setDefaultGroup(
            app('groups')->byIdOrFail($groupId),
        );

        return response(null, 204);
    }
}
