<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Transformers\UserCompactTransformer;

class GroupsController extends Controller
{
    public function show($id)
    {
        $group = app('groups')->byIdOrFail($id);
        abort_unless($group->hasListing(), 404);

        $currentMode = default_mode();
        $users = $group->users()
            ->with('statistics'.studly_case($currentMode))
            ->eagerloadForListing()
            ->default()
            ->orderBy('username', 'asc')
            ->get();

        $groupJson = json_item($group, 'Group', ['description']);
        $usersJson = json_collection(
            $users,
            (new UserCompactTransformer())->setMode($currentMode),
            UserCompactTransformer::LIST_INCLUDES,
        );

        return ext_view('groups.show', compact('groupJson', 'usersJson'));
    }
}
