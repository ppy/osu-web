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

use App\Libraries\BBCodeForDB;
use App\Models\DeletedUser;
use App\Models\Log;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'phpbb_posts';
    protected $primaryKey = 'post_id';
    protected $guarded = [];

    protected $dates = ['post_edit_time', 'post_time'];
    protected $dateFormat = 'U';
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
        } elseif ($user->isAdmin() === true) {
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
        return $query->orderBy('post_time', 'desc')->limit(1);
    }
}
