<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Group;
use App\Transformers\UserCompactTransformer;

class GroupsController extends Controller
{
    public function show($id)
    {
        $group = Group::withListing()->findOrFail($id);
        $currentMode = default_mode();

        $users = $group->users()
            ->with('statistics'.studly_case($currentMode))
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = $group->only('group_name', 'group_desc', 'has_playmodes');
        $transformer = new UserCompactTransformer();
        $transformer->mode = $currentMode;
        $usersJson = json_collection($users, $transformer, [
            'country',
            'cover',
            'groups',
            'statistics',
            'support_level',
        ]);

        return ext_view('groups.show', compact('groupJson', 'usersJson'));
    }
}
