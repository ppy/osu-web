<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Group;

class GroupsController extends Controller
{
    public function show($id)
    {
        $group = Group::visible()->findOrFail($id);
        $currentMode = studly_case(default_mode());

        $users = $group->users()
            ->with('statistics'.$currentMode)
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = $group->only('group_name', 'group_desc', 'has_playmodes');
        $usersJson = json_collection($users, 'UserCompact', [
            'cover',
            'country',
            'current_mode_rank',
            'groups',
            'support_level',
        ]);

        return ext_view('groups.show', compact('groupJson', 'usersJson'));
    }
}
