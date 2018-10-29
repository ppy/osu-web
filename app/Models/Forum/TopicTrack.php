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

namespace App\Models\Forum;

class TopicTrack extends Model
{
    protected $table = 'phpbb_topics_track';

    public $timestamps = false;
    protected $dates = ['mark_time'];
    protected $dateFormat = 'U';

    protected $primaryKeys = ['topic_id', 'user_id'];

    public static function readStatus($user, ...$topicsArrays)
    {
        if ($user === null) {
            return [];
        }

        $topics = [];

        foreach ($topicsArrays as $topicsArray) {
            foreach ($topicsArray as $topic) {
                $topics[] = $topic;
            }
        }

        $readStatus = static::where('user_id', '=', $user->getKey())
            ->whereIn('topic_id', array_pluck($topics, 'topic_id'))
            ->get()
            ->keyBy('topic_id');

        $forumReadStatus = ForumTrack::where('user_id', '=', $user->getKey())
            ->whereIn('forum_id', array_pluck($topics, 'forum_id'))
            ->get()
            ->keyBy('forum_id');

        $result = [];

        foreach ($topics as $topic) {
            $topicTime = $topic->topic_last_post_time;
            $topicId = $topic->getKey();
            $forumId = $topic->forum_id;

            $result[$topicId] =
                (isset($readStatus[$topicId]) && $topicTime <= $readStatus[$topicId]->mark_time) ||
                (isset($forumReadStatus[$forumId]) && $topicTime <= $forumReadStatus[$forumId]->mark_time);
        }

        return $result;
    }
}
