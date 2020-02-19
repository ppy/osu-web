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

use App\Models\Group;
use Auth;

class GroupsController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'groups-';

    public function show($id)
    {
        $group = Group::visible()->findOrFail($id);
        $currentMode = studly_case(Auth::user()->playmode ?? 'osu');

        $users = $group->users()
            ->with('statistics'.$currentMode)
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = $group->only('group_name', 'group_desc');
        $usersJson = json_collection($users, 'UserCompact', ['cover', 'country', 'current_mode_rank', 'support_level']);

        return ext_view('groups.show', compact('groupJson', 'usersJson'));
    }
}
