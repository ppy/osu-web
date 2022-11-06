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
            // 'limit:int',
            // 'sort:string',
            'user:string',
        ]);
        $query = UserGroupEvent::visibleForUser(auth()->user());

        if (isset($params['after'])) {
            $query->where('created_at', '>', $params['after']);
        }

        if (isset($params['before'])) {
            $query->where('created_at', '<', $params['before']);
        }

        if (isset($params['group'])) {
            // Not `app('groups')->byIdentifier(...)` because that would create the group if not found
            $query->where('group_id', app('groups')->allByIdentifier()->get($params['group'])?->getKey());
        }

        if (isset($params['user'])) {
            $query
                ->where('user_id', User::lookupWithHistory($params['user'], null, true)?->getKey())
                ->whereNotNull('user_id');
        }

        $cursorHelper = UserGroupEvent::makeDbCursorHelper(/* $params['sort'] ?? null */);
        [$events, $hasMore] = $query
            ->cursorSort($cursorHelper, cursor_from_params($rawParams))
            ->limit(50 /* clamp($params['limit'] ?? 50, 1, 50) */)
            ->getWithHasMore();
        $groups = app('groups')->all()->filter(
            fn (Group $group) => priv_check('GroupShow', $group)->can(),
        );
        $json = array_merge(
            cursor_for_response($hasMore ? $cursorHelper->next($events) : null),
            [
                'events' => json_collection($events, 'UserGroupEvent'),
                'groups' => json_collection($groups, 'Group'),
            ],
        );

        return is_json_request()
            ? $json
            : ext_view('group_history.index', compact('json'));
    }
}
