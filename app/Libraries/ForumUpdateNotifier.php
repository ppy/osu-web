<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Jobs\NotifyForumUpdateMail;
use App\Jobs\NotifyForumUpdateSlack;
use App\Models\Notification;

class ForumUpdateNotifier
{
    public static function onNew($data)
    {
        (new NotifyForumUpdateSlack($data, 'new'))->dispatchIfNeeded();
    }

    public static function onReply($data)
    {
        broadcast_notification(Notification::FORUM_TOPIC_REPLY, $data['post'], $data['user']);
        dispatch(new NotifyForumUpdateMail($data));

        (new NotifyForumUpdateSlack($data, 'reply'))->dispatchIfNeeded();
    }
}
