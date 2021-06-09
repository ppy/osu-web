<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserGroupsController extends Controller
{
    public function update()
    {
        [$user, $group] = $this->getUserAndGroupModels();
        $playmodes = get_arr(request()->input('playmodes'), 'get_string');

        $user->addToGroup($group, $playmodes);

        return response(null, 204);
    }

    public function destroy()
    {
        [$user, $group] = $this->getUserAndGroupModels();

        $user->removeFromGroup($group);

        return response(null, 204);
    }

    public function setDefault()
    {
        [$user, $group] = $this->getUserAndGroupModels();

        $user->setDefaultGroup($group);

        return response(null, 204);
    }

    private function getUserAndGroupModels()
    {
        $params = array_merge(
            ['group' => get_int(request()->input('group_id'))],
            request()->route()->parameters(),
        );

        $group = app('groups')->byId($params['group'] ?? null);
        abort_if($group === null, 404, 'Group not found');

        return [
            User::findOrFail($params['user'] ?? null),
            $group,
        ];
    }
}
