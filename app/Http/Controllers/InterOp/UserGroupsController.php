<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserGroupsController extends Controller
{
    public function store()
    {
        return $this->userGroupAction('addToGroup');
    }

    public function destroy()
    {
        return $this->userGroupAction('removeFromGroup');
    }

    public function setDefault()
    {
        return $this->userGroupAction('setDefaultGroup');
    }

    private function userGroupAction(string $userMethod)
    {
        $params = get_params(request()->all(), null, [
            'group_id:int',
            'user_id:int',
        ]);

        $group = app('groups')->byId($params['group_id'] ?? null);
        abort_if($group === null, 404, 'Group not found');

        User::findOrFail($params['user_id'])->$userMethod($group);

        return response(null, 204);
    }
}
