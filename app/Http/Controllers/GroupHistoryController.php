<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroupEvent;

class GroupHistoryController extends Controller
{
    public function index()
    {
        $rawParams = request()->all();
        $params = get_params($rawParams, null, [
            'after:time',
            'before:time',
            'group:string',
            'user:string',
        ], ['null_missing' => true]);
        $query = UserGroupEvent::visibleForUser(auth()->user());
        $skipQuery = false;

        if ($params['after'] !== null) {
            $query->where('created_at', '>', $params['after']);
        }

        if ($params['before'] !== null) {
            $query->where('created_at', '<', $params['before']);
        }

        if ($params['group'] !== null) {
            // Not `app('groups')->byIdentifier(...)` because that would create the group if not found
            $groupId = app('groups')->allByIdentifier()->get($params['group'])?->getKey();

            if ($groupId !== null) {
                $query->where('group_id', $groupId);
            } else {
                $skipQuery = true;
            }
        }

        if ($params['user'] !== null) {
            $userId = User::lookupWithHistory($params['user'], null, true)?->getKey();

            if ($userId !== null) {
                $query->where('user_id', $userId);
            } else {
                $skipQuery = true;
            }
        }

        if ($skipQuery) {
            $events = [];
            $hasMore = false;
        } else {
            $cursorHelper = UserGroupEvent::makeDbCursorHelper();
            [$events, $hasMore] = $query
                ->cursorSort($cursorHelper, cursor_from_params($rawParams))
                ->limit(50)
                ->getWithHasMore();
        }

        $groups = app('groups')->all()->filter(
            fn (Group $group) => priv_check('GroupShow', $group)->can(),
        );

        return [
            'events' => json_collection($events, 'UserGroupEvent'),
            'groups' => json_collection($groups, 'Group'),
            ...cursor_for_response($cursorHelper->next($events, $hasMore)),
        ];
    }
}
