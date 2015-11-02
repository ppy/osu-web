<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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
        'post_id' => 'integer',
        'poster_id' => 'integer',
    ];

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
        if ($user === null) {
            return new DeletedUser();
        }

        if ($user->isRestricted()) {
            $restrictedUser = new DeletedUser();
            $restrictedUser->username = $user->username;
            $restrictedUser->user_colour = 'ccc';

            return $restrictedUser;
        } else {
            return $user;
        }
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

    public function canBeDeletedBy($user, $position = null, $topicPostsCount = null, $positionCheck = true)
    {
        if ($user === null) {
            return false;
        } elseif ($user->isAdmin() === true) {
            return true;
        } elseif ($this->poster_id !== $user->user_id) {
            return false;
        } else {
            if ($positionCheck === false) {
                return true;
            }

            if ($position === null) {
                $position = $this->postPosition;
            }

            if ($topicPostsCount === null) {
                $topicPostsCount = $this->topic->postsCount();
            }

            return $position === $topicPostsCount;
        }
    }

    public function canBeEditedBy($user)
    {
        if ($user === null) {
            return false;
        } elseif ($this->poster_id === $user->user_id) {
            return true;
        } elseif ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($body, $user)
    {
        if ($body === $this->bodyRaw) {
            return true;
        }

        return $this->update([
            'post_text' => $body,
            'post_edit_time' => Carbon::now(),
            'post_edit_count' => DB::raw('post_edit_count + 1'),
            'post_edit_user' => $user->user_id,
        ]);
    }

    public function getBodyHTMLAttribute()
    {
        return bbcode($this->post_text, $this->bbcode_uid, true);
    }

    public function getBodyRawAttribute()
    {
        return bbcode_for_editor($this->post_text, $this->bbcode_uid);
    }
}
