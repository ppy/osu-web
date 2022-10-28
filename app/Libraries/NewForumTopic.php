<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\User;
use Carbon\Carbon;

class NewForumTopic
{
    public function __construct(private Forum $forum, private ?User $user)
    {
    }

    public function cover()
    {
        return json_item(null, 'Forum/TopicCover');
    }

    public function post()
    {
        $body = null;

        if ($this->forum->isHelpForum()) {
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
        if ($this->forum->isHelpForum()) {
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
