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

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TopicWatch extends Model
{
    protected $table = 'phpbb_topics_watch';
    protected $guarded = [];
    protected $casts = [
        'notify_status' => 'boolean',
    ];

    public $timestamps = false;

    public static function unreadCount($user)
    {
        if ($user === null) {
            return 0;
        }

        $watch = new static;
        $topic = new Topic;
        $track = new TopicTrack;

        return static
            ::join($topic->getTable(), $topic->qualifyColumn('topic_id'), '=', $watch->qualifyColumn('topic_id'))
            ->leftJoin($track->getTable(), function ($join) use ($track, $watch) {
                $join
                    ->on($track->qualifyColumn('topic_id'), '=', $watch->qualifyColumn('topic_id'))
                    ->on($track->qualifyColumn('user_id'), '=', $watch->qualifyColumn('user_id'));
            })
            ->where($watch->qualifyColumn('user_id'), '=', $user->user_id)
            ->where(function ($query) use ($topic, $track) {
                $query
                    ->whereRaw("{$topic->qualifyColumn('topic_last_post_time')} > {$track->qualifyColumn('mark_time')}")
                    ->orWhereNull($track->qualifyColumn('mark_time'));
            })
            ->count();
    }

    public static function check($topic, $user)
    {
        if ($user === null) {
            return false;
        }

        return static::lookupQuery($topic, $user)->exists();
    }

    public static function lookup($topic, $user)
    {
        if ($user === null) {
            return new static(['topic_id' => $topic->getKey()]);
        } else {
            return static::lookupQuery($topic, $user)->first() ?? new static([
                'topic_id' => $topic->getKey(),
                'user_id' => $user->getKey(),
            ]);
        }
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeLookupQuery($query, $topic, $user)
    {
        if ($user instanceof User) {
            $userId = $user->getKey();
        } elseif (is_string($user) || is_int($user)) {
            $userId = (int) $user;
        }

        if ($topic instanceof Topic) {
            $topicId = $topic->getKey();
        } elseif (is_string($topic) || is_int($topic)) {
            $topicId = (int) $topic;
        }

        if (!isset($userId) || !isset($topicId)) {
            return $query->none();
        }

        return $query->where([
            'topic_id' => $topicId,
            'user_id' => $userId,
        ]);
    }

    // Allows save/update/delete to work with composite primary keys.
    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->lookupQuery($this->topic_id, $this->user_id);
    }
}
