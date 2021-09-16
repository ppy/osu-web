<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Models\User;

/**
 * @property bool $mail
 * @property bool $notify_status
 * @property Topic $topic
 * @property int $topic_id
 * @property User $user
 * @property int $user_id
 */
class TopicWatch extends Model
{
    protected $table = 'phpbb_topics_watch';
    protected $casts = [
        'notify_status' => 'boolean',
        'mail' => 'boolean',
    ];

    public $timestamps = false;

    protected $primaryKeys = ['topic_id', 'user_id'];

    public static function unreadCount($user)
    {
        if ($user === null) {
            return 0;
        }

        $watch = new static();
        $topic = new Topic();
        $track = new TopicTrack();

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

    public static function watchStatus($user, $topics)
    {
        return static::where('user_id', '=', $user->getKey())
            ->whereIn('topic_id', $topics->pluck('topic_id'))
            ->get()
            ->keyBy('topic_id');
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

    public static function setState($topic, $user, $state)
    {
        $tries = 0;

        while (true) {
            $watch = static::lookup($topic, $user);

            try {
                if ($state === 'not_watching') {
                    $notify = false;
                    $watch->delete();
                } else {
                    $notify = $state === 'watching_mail';

                    $watch->fill(['mail' => $notify])->saveOrExplode();
                }

                return $watch;
            } catch (Exception $e) {
                if (is_sql_unique_exception($e) && $tries < 2) {
                    $tries++;
                } else {
                    throw $e;
                }
            }
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
        } else {
            return $query->none();
        }

        if ($topic instanceof Topic) {
            $topicId = $topic->getKey();
        } elseif (is_string($topic) || is_int($topic)) {
            $topicId = (int) $topic;
        } else {
            return $query->none();
        }

        return $query->where([
            'topic_id' => $topicId,
            'user_id' => $userId,
        ]);
    }

    public function stateText()
    {
        if ($this->exists) {
            return $this->mail ? 'watching_mail' : 'watching';
        } else {
            return 'not_watching';
        }
    }
}
