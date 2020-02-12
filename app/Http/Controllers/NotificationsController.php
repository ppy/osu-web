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

use App\Libraries\NotificationsBundle;
use App\Models\UserNotification;

/**
 * @group Notification
 */
class NotificationsController extends Controller
{
    const LIMIT = 51;

    protected $section = 'user';
    protected $actionPrefix = 'notifications-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function endpoint()
    {
        return ['url' => $this->endpointUrl()];
    }

    /**
     * Get Notifications
     *
     * This endpoint returns a list of the user's unread notifications. Sorted descending by `id` with limit of 50.
     *
     * ---
     *
     * ### Response Format
     *
     * Returns an object containing [Notification](#notification) and other related attributes.
     *
     * Field                 | Type
     * --------------------- | ---------------------------------------------------
     * has_more              | boolean whether or not there are more notifications
     * notifications         | array of [Notification](#notification)
     * unread_count          | total unread notifications
     * notification_endpoint | url to connect to websocket server
     *
     * @authenticated
     *
     * @queryParam max_id Maximum `id` fetched. Can be used to load earlier notifications. Defaults to no limit (fetch latest notifications)
     *
     * @response {
     *   "has_more": true,
     *   "notifications": [
     *     {
     *       "id": 1,
     *       "name": "forum_topic_reply",
     *       "created_at": "2019-04-24T07:12:43+00:00",
     *       "object_type": "forum_topic",
     *       "object_id": 1,
     *       "source_user_id": 1,
     *       "is_read": false,
     *       "details": {
     *           "title": "A topic",
     *           "post_id": 2,
     *           "username": "User",
     *           "cover_url": "https://..."
     *       }
     *     }
     *   ],
     *   "unread_count": 100,
     *   "notification_endpoint": "wss://notify.ppy.sh"
     * }
     */
    public function index()
    {
        $bundle = new NotificationsBundle(auth()->user(), request()->all());
        $bundleJson = $bundle->toArray();

        if (is_json_request()) {
            $bundleJson['notification_endpoint'] = $this->endpointUrl();

            return response($bundleJson)->header('Cache-Control', 'no-store');
        }

        return ext_view('notifications.index', compact('bundleJson'));
    }

    /**
     * Mark Notifications as Read
     *
     * This endpoint allows you to mark notifications read.
     *
     * ---
     *
     * ### Response Format
     *
     * _empty response_
     *
     * @authenticated
     *
     * @bodyParam ids integer[] required `id` of notifications to be marked as read  Example: [1, 2, 3]
     *
     * @response 204
     */
    public function markRead()
    {
        // TODO: params validation
        $params = get_params(request()->all(), null, [
            'category:string',
            'id:int',
            'notifications:any',
            'object_id:int',
            'object_type:string',
        ]);

        if (isset($params['notifications'])) {
            UserNotification::markAsReadByIds(auth()->user(), $params['notifications']);
        } else {
            UserNotification::markAsReadByNotificationIdentifier(auth()->user(), $params);
        }

        return response(null, 204);
    }

    private function endpointUrl()
    {
        $url = config('osu.notification.endpoint');

        if (($url[0] ?? null) === '/') {
            $host = request()->getHttpHost();
            $protocol = request()->secure() ? 'wss' : 'ws';
            $url = "{$protocol}://{$host}{$url}";
        }

        return $url;
    }
}
