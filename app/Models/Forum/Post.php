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

use App\Libraries\BBCodeForDB;
use App\Models\DeletedUser;
use App\Models\Log;
use Carbon\Carbon;
use DB;
use Es;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'phpbb_posts';
    protected $primaryKey = 'post_id';
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'post_edit_locked' => 'boolean',
        'post_approved' => 'boolean',
    ];

    private $normalizedUsers = [];

    public function forum()
    {
        return $this->belongsTo("App\Models\Forum\Forum", 'forum_id', 'forum_id');
    }

    public function topic()
    {
        return $this->belongsTo("App\Models\Forum\Topic", 'topic_id', 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", 'poster_id', 'user_id');
    }

    public function lastEditor()
    {
        return $this->belongsTo("App\Models\User", 'post_edit_user', 'user_id');
    }

    public function setPostTextAttribute($value)
    {
        $bbcode = new BBCodeForDB($value);
        $this->attributes['post_text'] = $bbcode->generate();
        $this->attributes['bbcode_uid'] = $bbcode->uid;
        $this->attributes['bbcode_bitfield'] = $bbcode->bitfield;
    }

    public function setPostTimeAttribute($value)
    {
        $this->attributes['post_time'] = $value->timestamp;
    }

    public function getPostTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setPostEditTimeAttribute($value)
    {
        $this->attributes['post_edit_time'] = $value->timestamp;
    }

    public function getPostEditTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public static function lastUnreadByUser($topic, $user)
    {
        if ($user === null) {
            return;
        }

        $startTime = TopicTrack::where('topic_id', $topic->topic_id)
            ->where('user_id', $user->user_id)
            ->value('mark_time');

        if ($startTime === null) {
            return;
        }

        $unreadPostId = $topic
            ->posts()
            ->where('post_time', '>=', $startTime->getTimestamp())
            ->value('post_id');

        if ($unreadPostId === null) {
            return $topic->posts()->orderBy('post_id', 'desc')->value('post_id');
        }

        return $unreadPostId;
    }

    public static function search($params)
    {
        $ids = static::searchES(static::searchParams($params));

        return count($ids) > 0
            ? static
                ::with('topic')
                ->whereIn('post_id', $ids)
                ->orderByField('post_id', $ids)
                ->get()
            : [];
    }

    public static function searchES($params = [])
    {
        $query = es_query_and_words($params['query']);

        if (!empty($params['user_ids'])) {
            $query .= ' AND user_id:('.implode(' OR ', $params['user_ids']).')';
        }

        if (!empty($params['forum_ids'])) {
            $query .= ' AND forum_id:('.implode(' OR ', $params['forum_ids']).')';
        }

        if (isset($params['topic_id'])) {
            $query .= ' AND topic_id:'.$params['topic_id'];
        }

        $searchParams = [
            'index' => config('osu.elasticsearch.index'),
            'type' => 'posts',
            'size' => $params['limit'],
            'from' => ($params['page'] - 1) * $params['limit'],
            'q' => $query,
        ];

        $resultEs = Es::search($searchParams);

        $result = [];

        foreach ($resultEs['hits']['hits'] ?? [] as $post) {
            $result[] = $post['_id'];
        }

        return $result;
    }

    public static function searchParams($params)
    {
        $params['query'] = $params['query'] ?? null;
        $params['limit'] = max(1, min(50, $params['limit'] ?? 50));
        $params['page'] = max(1, $params['page'] ?? 1);
        $params['user_ids'] = get_arr($params['user_ids'] ?? null, 'get_int');
        $params['forum_ids'] = get_arr($params['forum_ids'] ?? null, 'get_int');
        $params['topic_id'] = get_int($params['topic_id'] ?? null);

        return $params;
    }

    public function normalizeUser($user)
    {
        $key = $user === null ? 'user-null' : "user-{$user->user_id}";

        if (!isset($this->normalizedUsers[$key])) {
            if ($user === null) {
                $normalizedUser = new DeletedUser();
            } elseif ($user->isRestricted()) {
                $normalizedUser = new DeletedUser();
                $normalizedUser->username = $user->username;
                $normalizedUser->user_colour = 'ccc';
            } else {
                $normalizedUser = $user;
            }

            $this->normalizedUsers[$key] = $normalizedUser;
        }

        return $this->normalizedUsers[$key];
    }

    public function userNormalized()
    {
        return $this->normalizeUser($this->user);
    }

    public function lastEditorNormalized()
    {
        return $this->normalizeUser($this->lastEditor);
    }

    public function getPostPositionAttribute()
    {
        return $this->topic->postPosition($this->post_id);
    }

    public function edit($body, $user)
    {
        if ($body === $this->bodyRaw) {
            return true;
        }

        $updates = [
            'post_text' => $body,
        ];

        if ($user->user_id === $this->poster_id) {
            $updates = array_merge($updates, [
                'post_edit_time' => Carbon::now(),
                'post_edit_count' => DB::raw('post_edit_count + 1'),
                'post_edit_user' => $user->user_id,
            ]);
        } else {
            Log::logModerateForumPost('LOG_POST_EDITED', $this);
        }

        return $this->update($updates);
    }

    public function getBodyHTMLAttribute()
    {
        return bbcode($this->post_text, $this->bbcode_uid, true);
    }

    public function getBodyRawAttribute()
    {
        return bbcode_for_editor($this->post_text, $this->bbcode_uid);
    }

    public function scopeLast($query)
    {
        return $query->orderBy('post_id', 'desc')->limit(1);
    }

    public function scopeShowDeleted($query, $showDeleted)
    {
        if ($showDeleted) {
            $query->withTrashed();
        }
    }
}
