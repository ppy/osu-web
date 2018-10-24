<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries;

use App\Models\Forum\Post;
use Carbon\Carbon;

class NewForumTopic
{
    private $forum;

    public function __construct($forum, $user)
    {
        $this->forum = $forum;
        $this->user = $user;
    }

    public function cover()
    {
        return json_item(null, 'Forum/TopicCover');
    }

    public function post()
    {
        $body = null;

        if ($this->forum->forum_id === config('osu.forum.help_forum_id')) {
            $client = $this->user->clients()->last('timestamp');

            $buildName = '';

            if ($client !== null && $client->build !== null && $client->build->updateStream !== null) {
                $build = $client->build;
                $stream = $build->updateStream;
                $buildName = $stream->pretty_name.' '.$build->displayVersion();
                if ($client->isLatest()) {
                    $buildName .= ' (latest)';
                }
            }

            // In English language forum, no localization.
            $body = 'Problem details:';
            $body .= "\n\n\n";
            $body .= 'Video or screenshot showing the problem:';
            $body .= "\n\n\n";
            $body .= "osu! version: {$buildName}";
        }

        return new Post([
            'post_text' => $body,
            'user' => $this->user,
            'post_time' => Carbon::now(),
        ]);
    }

    public function titlePlaceholder()
    {
        if ($this->forum->forum_id === config('osu.forum.help_forum_id')) {
            // In English language forum, no localization.
            return 'What is your problem (50 characters)';
        }
    }

    public function toArray()
    {
        return [
            'cover' => $this->cover(),
            'forum' => $this->forum,
            'post' => $this->post(),
            'titlePlaceholder' => $this->titlePlaceholder(),
        ];
    }
}
