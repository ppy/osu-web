<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroupEvent;

class GroupHistoryController extends Controller
{
    public function index()
    {
        $rawParams = request()->all();
        $params = get_params($rawParams, null, [
            'group:string',
            'max_date:time',
            'min_date:time',
            'sort:string',
            'user:string',
        ], ['null_missing' => true]);
        $query = UserGroupEvent::visibleForUser(auth()->user());

        if ($params['group'] !== null) {
            $groupId = app('groups')->byIdentifier($params['group'])?->getKey();

            if ($groupId !== null) {
                $query->where('group_id', $groupId);
            } else {
                $query->none();
            }
        }

        if ($params['max_date'] !== null) {
            $query->where('created_at', '<=', $params['max_date']);
        }

        if ($params['min_date'] !== null) {
            $query->where('created_at', '>=', $params['min_date']);
        }

        if ($params['user'] !== null) {
            $userId = User::lookupWithHistory($params['user'], null, true)?->getKey();

            if ($userId !== null) {
                $query->where('user_id', $userId);
            } else {
                $query->none();
            }
        }

        $cursorHelper = UserGroupEvent::makeDbCursorHelper($params['sort']);
        [$events, $hasMore] = $query
            ->cursorSort($cursorHelper, cursor_from_params($rawParams))
            ->limit(50)
            ->getWithHasMore();
        $cursor = $cursorHelper->next($events, $hasMore);

        return [
            'events' => json_collection($events, 'UserGroupEvent'),
            ...cursor_for_response($cursor),
        ];
    }
}
