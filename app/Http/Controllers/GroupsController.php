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
