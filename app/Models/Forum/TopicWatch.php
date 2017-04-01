<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use Illuminate\Database\QueryException;

class TopicWatch extends Model
{
    protected $table = 'phpbb_topics_watch';
    protected $guarded = [];

    public $timestamps = false;

    public static function unreadCount($user)
    {
        if ($user === null) {
            return 0;
        }

        $thisTable = (new static)->getTable();
        $trackTable = (new TopicTrack)->getTable();
        $topicTable = (new Topic)->getTable();

        return static
            ::join($topicTable, "{$topicTable}.topic_id", '=', "{$thisTable}.topic_id")
            ->leftJoin($trackTable, function ($join) use ($trackTable, $thisTable) {
                $join
                    ->on("{$trackTable}.topic_id", '=', "{$thisTable}.topic_id")
                    ->on("{$trackTable}.user_id", '=', "{$thisTable}.user_id");
            })
            ->where("{$thisTable}.user_id", '=', $user->user_id)
            ->where(function ($query) use ($topicTable, $trackTable) {
                $query
                    ->whereRaw("{$topicTable}.topic_last_post_time > {$trackTable}.mark_time")
                    ->orWhereNull("{$trackTable}.mark_time");
            })
            ->count();
    }

    public static function add($topic, $user)
    {
        try {
            return static::create([
                'topic_id' => $topic->topic_id,
                'user_id' => $user->user_id,
            ]);
        } catch (QueryException $ex) {
            // Do nothing if already watching. Rethrow everything else.
            if (!is_sql_unique_exception($ex)) {
                throw $ex;
            }
        }
    }

    public static function check($topic, $user)
    {
        if ($user === null) {
            return false;
        }

        return static::where([
            'topic_id' => $topic->topic_id,
            'user_id' => $user->user_id,
        ])->exists();
    }

    public static function remove($topics, $user)
    {
        return static::where('user_id', $user->user_id)
            ->whereIn('topic_id', array_pluck((array) $topics, 'topic_id'))
            ->delete();
    }

    public static function toggle($topic, $user, $isAdd)
    {
        $function = $isAdd ? 'add' : 'remove';

        return forward_static_call_array([static::class, $function], [$topic, $user]);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
