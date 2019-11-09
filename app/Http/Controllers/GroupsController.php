<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\Group;

class GroupsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'groups-';

    public function show($id)
    {
        $group = Group::visible()->findOrFail($id);

        $users = $group->users()
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = $group->only('group_name', 'group_desc');
        $usersJson = json_collection($users, 'UserCompact', ['cover', 'country', 'support_level']);

        return view('groups.show', compact('groupJson', 'usersJson'));
    }
}
