<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph\Forum;

use App\Libraries\Opengraph\OpengraphInterface;
use App\Models\Forum\Topic;

class TopicOpengraph implements OpengraphInterface
{
    public function __construct(private Topic $topic)
    {
    }

    public function get(): array
    {
        $forumDescription = (new ForumOpengraph($this->topic->forum))->description();

        return [
            'description' => "{$forumDescription} » {$this->topic->topic_title}",
            'image' => $this->topic->cover?->file()->url() ?? $this->topic->forum->cover?->defaultTopicCover->url(),
            'title' => $this->topic->topic_title,
        ];
    }
}
