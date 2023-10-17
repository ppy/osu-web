<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph\Forum;

use App\Libraries\Opengraph\OpengraphInterface;
use App\Models\Forum\Forum;

class ForumOpengraph implements OpengraphInterface
{
    public function __construct(private Forum $forum)
    {
    }

    // Reminder to update Topic::toOpengraph() as necessary if this value changes.
    public function description(): string
    {
        $stack = [osu_trans('forum.title')];
        foreach ($this->forum->forum_parents as $forumId => $forumData) {
            $stack[] = $forumData[0];
        }

        $stack[] = $this->forum->forum_name;

        return implode(' » ', $stack);
    }

    public function get(): array
    {

        return [
            'description' => $this->description(),
            'title' => $this->forum->forum_name,
            'image' => $this->forum->cover?->file()->Url(),
        ];
    }
}
