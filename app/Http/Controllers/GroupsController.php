<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Transformers\UserCompactTransformer;

class GroupsController extends Controller
{
    public function show($id)
    {
        $group = app('groups')->byId($id);
        abort_if($group === null || !$group->hasListing(), 404, 'Group not found');

        $currentMode = default_mode();
        $users = $group->users()
            ->with('statistics'.studly_case($currentMode))
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = json_item($group, 'Group');
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
