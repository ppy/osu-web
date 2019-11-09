<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Forum;

/**
 * @property int $forum_id
 * @property int $mark_time
 * @property int $topic_id
 * @property int $user_id
 */
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
                $topicTime <= $user->user_lastmark ||
                (isset($readStatus[$topicId]) && $topicTime <= $readStatus[$topicId]->mark_time) ||
                (isset($forumReadStatus[$forumId]) && $topicTime <= $forumReadStatus[$forumId]->mark_time);
        }

        return $result;
    }
}
