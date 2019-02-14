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

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Libraries\CommentBundle;
use App\Libraries\MorphMap;
use App\Models\Notification;
use App\Models\Log;
use Carbon\Carbon;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationsController extends Controller
{
    protected $section = 'community';
    protected $actionPrefix = 'comments-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index()
    {
        $userNotifications = auth()
            ->user()
            ->userNotifications()
            ->with('notification')
            ->orderBy('id', 'DESC')
            ->limit(50)
            ->get();

        $json = json_collection($userNotifications, 'UserNotification', ['notification']);

        $unreadCount = auth()->user()->userNotifications()->where('is_read', false)->count();

        return [
            'user_notifications' => $json,
            'unread_count' => $unreadCount,
        ];
    }
}
