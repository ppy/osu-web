<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\LegacyMatch;
use App\Models\NewsPost;
use App\Models\Score;
use App\Models\Solo;
use App\Models\User;

class MorphMap
{
    const MAP = [
        BeatmapDiscussion::class => 'beatmapset_discussion',
        BeatmapDiscussionPost::class => 'beatmapset_discussion_post',
        Beatmapset::class => 'beatmapset',
        Build::class => 'build',
        Channel::class => 'channel',
        Comment::class => 'comment',
        Forum\Post::class => 'forum_post',
        Forum\Topic::class => 'forum_topic',
        LegacyMatch\Score::class => 'legacy_match_score',
        Message::class => 'message',
        NewsPost::class => 'news_post',
        Score\Best\Fruits::class => 'score_best_fruits',
        Score\Best\Mania::class => 'score_best_mania',
        Score\Best\Osu::class => 'score_best_osu',
        Score\Best\Taiko::class => 'score_best_taiko',
        Score\Fruits::class => 'score_fruits',
        Score\Mania::class => 'score_mania',
        Score\Osu::class => 'score_osu',
        Score\Taiko::class => 'score_taiko',
        Solo\Score::class => 'solo_score',
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
        return static::flippedMap()[$type] ?? null;
    }

    public static function flippedMap()
    {
        static $ret;

        return $ret ??= array_flip(static::MAP);
    }
}
