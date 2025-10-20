<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Models\Forum\TopicCover;
use App\Models\User;
use App\Transformers\Forum\TopicCoverTransformer;
use Carbon\Carbon;

class NewForumTopic
{
    public function __construct(private Forum $forum, private ?User $user)
    {
    }

    public function cover()
    {
        $cover = new TopicCover();
        $cover->newForumId = $this->forum->getKey();

        return json_item($cover, new TopicCoverTransformer());
    }

    public function post()
    {
        $body = null;

        if ($this->forum->isHelpForum()) {
            $buildName = '';

            $build = $this->user->soloScores()->last()?->build
                // the build above will be null if the user last played on stable
                ?? $this->user->clients()->last('timestamp')?->build;
            $stream = $build?->parent()?->updateStream;

            if ($stream !== null) {
                $buildName = $stream->pretty_name.' '.$build->version;
                if ($build->isLatest()) {
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

    public function titlePlaceholder(): ?string
    {
        return $this->forum->isHelpForum()
            // In English language forum, no localization.
            ? 'What is your problem (50 characters)'
            : null;
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
