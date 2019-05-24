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

use App\Events\NotificationReadEvent;

class NotificationsController extends Controller
{
    const LIMIT = 51;

    protected $section = 'community';
    protected $actionPrefix = 'notifications_';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        $withRead = get_bool(request('with_read')) ?? false;
        $hasMore = false;
        $userNotificationsQuery = auth()
            ->user()
            ->userNotifications()
            ->with('notification.notifiable')
            ->with('notification.source')
            ->orderBy('notification_id', 'DESC')
            ->limit(static::LIMIT);

        if (!$withRead) {
            $userNotificationsQuery->where('is_read', false);
        }

        $maxId = get_int(request('max_id'));
        if (isset($maxId)) {
            $userNotificationsQuery->where('notification_id', '<=', $maxId);
        }

        $userNotifications = $userNotificationsQuery->get();

        if ($userNotifications->count() === static::LIMIT) {
            $hasMore = true;
            $userNotifications->pop();
        }

        $json = json_collection($userNotifications, 'Notification');

        $unreadCount = auth()->user()->userNotifications()->where('is_read', false)->count();

        return [
            'has_more' => $hasMore,
            'notifications' => $json,
            'unread_count' => $unreadCount,
            'notification_endpoint' => config('osu.notification.endpoint'),
        ];
    }

    public function markRead()
    {
        $user = auth()->user();
        $ids = get_params(request()->all(), null, ['ids:int[]'])['ids'] ?? [];
        $itemsQuery = $user->userNotifications()->whereIn('notification_id', $ids);

        if ($itemsQuery->update(['is_read' => true])) {
            event(new NotificationReadEvent($user->getKey(), $ids));

            return response(null, 204);
        } else {
            return response(null, 422);
        }
    }
}
