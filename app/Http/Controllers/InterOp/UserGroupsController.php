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
            $this->getActor(),
        );

        return response()->noContent();
    }

    public function destroy($userId, $groupId)
    {
        User::findOrFail($userId)->removeFromGroup(
            app('groups')->byIdOrFail($groupId),
            $this->getActor(),
        );

        return response()->noContent();
    }

    public function setDefault($userId, $groupId)
    {
        User::findOrFail($userId)->setDefaultGroup(
            app('groups')->byIdOrFail($groupId),
            $this->getActor(),
        );

        return response()->noContent();
    }

    private function getActor(): ?User
    {
        $actorId = request()->input('actor_id');

        return present($actorId) ? User::findOrFail($actorId) : null;
    }
}
