<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Jobs\Notifications\ForumTopicReply;
use App\Jobs\NotifyForumUpdateSlack;

class ForumUpdateNotifier
{
    public static function onNew($data)
    {
        (new NotifyForumUpdateSlack($data, 'new'))->dispatchIfNeeded();
    }

    public static function onReply($data)
    {
        (new ForumTopicReply($data['post'], $data['user']))->dispatch();

        (new NotifyForumUpdateSlack($data, 'reply'))->dispatchIfNeeded();
    }
}
