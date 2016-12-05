<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Illuminate\Database\Eloquent\Model;

class TopicTrack extends Model
{
    protected $table = 'phpbb_topics_track';
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = ['mark_time'];
    protected $dateFormat = 'U';

    public static function readStatus($user, ...$topicsArrays)
    {
        if (!$user) {
            return [];
        }

        $topicData = [];
        foreach ($topicsArrays as $topics) {
            foreach ($topics as $topic) {
                $topicData[$topic->topic_id] = $topic->topic_last_post_time;
            }
        }
        $readStatus = self::where('user_id', $user->user_id)
            ->whereIn('topic_id', array_keys($topicData))
            ->select('topic_id', 'mark_time')
            ->get();

        $result = [];
        foreach ($readStatus as $r) {
            if ($r->mark_time >= $topicData[$r->topic_id]) {
                $result[$r->topic_id] = true;
            }
        }

        return $result;
    }
}
