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

namespace App\Libraries;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Chat\Channel;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\NewsPost;
use App\Models\Score;
use App\Models\User;

class MorphMap
{
    const MAP = [
        BeatmapDiscussion::class => 'beatmapset_discussion',
        Beatmapset::class => 'beatmapset',
        BeatmapDiscussionPost::class => 'beatmapset_discussion_post',
        Build::class => 'build',
        Channel::class => 'channel',
        Comment::class => 'comment',
        Forum\Topic::class => 'forum_topic',
        NewsPost::class => 'news_post',
        Score\Best\Fruits::class => 'score_best_fruits',
        Score\Best\Mania::class => 'score_best_mania',
        Score\Best\Osu::class => 'score_best_osu',
        Score\Best\Taiko::class => 'score_best_taiko',
        User::class => 'user',
    ];

    public static function getType($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        return static::MAP[$class] ?? null;
    }

    public static function getClass($type)
    {
        return array_search_null($type, static::MAP);
    }
}
