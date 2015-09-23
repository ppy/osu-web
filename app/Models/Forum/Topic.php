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

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Topic extends Model
{
    protected $table = 'phpbb_topics';
    protected $primaryKey = 'topic_id';
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = ['topic_last_view_time', 'topic_last_post_time'];
    protected $dateFormat = 'U';

    private $postsCount;
    private $_canBeRepliedBy = [];

    private $issueTypes = 'resolved|invalid|duplicate|confirmed';

    protected $casts = [
        'forum_id' => 'integer',
        'topic_first_post_id' => 'integer',
        'topic_id' => 'integer',
        'topic_last_post_id' => 'integer',
        'topic_poster' => 'integer',
        'topic_status' => 'integer',
        'topic_type' => 'integer',
    ];

    public static function createNew($forum, $title, $poster, $body, $notifyReplies)
    {
        $topic = new self([
            'forum_id' => $forum->forum_id,
            'topic_time' => time(),
            'topic_title' => $title,
            'topic_poster' => $poster->user_id,
            'topic_first_poster_name' => $poster->username,
            'topic_first_poster_colour' => $poster->user_colour,
        ]);

        DB::transaction(function () use ($topic, $forum, $title, $poster, $body, $notifyReplies) {
            $topic->save();
            $topic->addPost($poster, $body, $notifyReplies);
        });

        return $topic;
    }

    public static function isDoublePost($post)
    {
        $postTime = $post['post_time'];
        $now = Carbon::now();
        $diffSinceLastPost = $now->diffInDays($postTime);
        if (! is_null(Auth::user()) && $post['poster_id'] == Auth::user()->user_id && $diffSinceLastPost < 3) {
            return true;
        }

        return false;
    }

    public function addPost($poster, $body, $notifyReplies)
    {
        DB::transaction(function () use ($poster, $body, $notifyReplies) {
            $updateTime = Carbon::now();

            $post = new Post([
                'post_text' => $body,
                'post_username' => $poster->username,
                'poster_id' => $poster->user_id,
                'forum_id' => $this->forum_id,
                'post_time' => $updateTime,
            ]);

            $this->posts()->save($post);

            // of course the $topic hasn't been reloaded after saving and thus still has
            // value of null (instead of default zero). But add the check if zero anyway.
            if ($this->topic_first_post_id === null || $this->topic_first_post_id === 0) {
                $this->update(['topic_first_post_id' => $post->post_id]);
            } else {
                $this->update([
                    'topic_replies' => DB::raw('topic_replies + 1'),
                    'topic_replies_real' => DB::raw('topic_replies_real + 1'),
                ]);
            }

            $this->refreshLastPostCache($post);

            $this->forum->increment('forum_posts');
            $this->forum->refreshLastPostCache($post);

            $poster->update([
                'user_posts' => DB::raw('user_posts + 1'),
                'user_lastpost_time' => $updateTime,
            ]);
        });

        return true;
    }

    public function removePost($post)
    {
        DB::transaction(function () use ($post) {
            $post->delete();

            $postsCount = $this->posts()->count();
            if ($postsCount === 0) {
                $this->delete();
            } else {
                $firstPost = $this->posts()->first();
                if ($this->topic_first_post_id !== $firstPost->post_id) {
                    $this->update([
                        'topic_first_post_id' => $firstPost->post_id,
                        'topic_poster' => $firstPost->user->user_id,
                        'topic_first_poster_name' => $firstPost->user->username,
                        'topic_first_poster_colour' => $firstPost->user->user_colour,
                    ]);
                }

                $this->update([
                    'topic_replies' => DB::raw('topic_replies - 1'),
                    'topic_replies_real' => DB::raw('topic_replies_real - 1'),
                ]);

                $this->refreshLastPostCache();

                $this->forum->decrement('forum_posts');
                $this->forum->refreshLastPostCache();

                $post->user->decrement('user_posts');
            }
        });

        return true;
    }

    public function posts()
    {
        return $this->hasMany("App\Models\Forum\Post", 'topic_id', 'topic_id');
    }

    public function forum()
    {
        return $this->belongsTo("App\Models\Forum\Forum", 'forum_id', 'forum_id');
    }

    public function titleNormalized()
    {
        if ($this->isIssue() === false) {
            return $this->topic_title;
        }

        return trim(preg_replace("/\[({$this->issueTypes})\]/i", '', $this->topic_title));
    }

    public function issues()
    {
        if ($this->isIssue() === false) {
            return [];
        }

        preg_match_all("/\[({$this->issueTypes})\]/i", $this->topic_title, $issues);

        return array_map(function ($value) { return strtolower($value); }, $issues[1]);
    }

    public function scopePinned($query)
    {
        return $query->where('topic_type', '<>', 0);
    }

    public function scopeNormal($query)
    {
        return $query->where('topic_type', 0);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('topic_last_post_time', 'desc');
    }

    public function nthPost($n)
    {
        return $this->posts()->skip(intval($n) - 1)->first();
    }

    public function postPosition($postId)
    {
        return $this->posts()->where('post_id', '<=', $postId)->count();
    }

    public function postsPosition($sortedPosts)
    {
        if ($sortedPosts->count() === 0) {
            return [];
        }

        $firstPostPosition = $this->postPosition($sortedPosts->first()->post_id);
        $postIds = $sortedPosts->map(function ($p) { return $p->post_id; });

        $buf = [];
        $currentPostPosition = $firstPostPosition;
        foreach ($postIds as $postId) {
            $buf[$postId] = $currentPostPosition;
            $currentPostPosition++;
        }

        return $buf;
    }

    public function postsCount()
    {
        if ($this->postsCount === null) {
            $this->postsCount = $this->posts()->count();
        }

        return $this->postsCount;
    }

    public function isLocked()
    {
        return $this->topic_status === 1;
    }

    public function canBeRepliedBy($user)
    {
        $key = $user === null ? '-1' : "{$user->user_id}";
        if (! isset($this->_canBeRepliedBy[$key])) {
            $this->_canBeRepliedBy[$key] = Authorize::canPost($user, $this->forum, $this);
        }

        return $this->_canBeRepliedBy[$key];
    }

    public function markRead($user, $markTime)
    {
        if ($user === null) {
            return;
        }

        $status = TopicTrack::where(['user_id' => $user->user_id, 'topic_id' => $this->topic_id]);

        if ($status->first() === null) {
            // first time seeing the topic, create tracking entry
            // and increment views count
            TopicTrack::create([
                'user_id' => $user->user_id,
                'topic_id' => $this->topic_id,
                'forum_id' => $this->forum_id,
                'mark_time' => $markTime,
            ]);

            $this->increment('topic_views');
        } elseif ($status->first()->mark_time < $markTime) {
            // laravel doesn't like composite key ;_;
            // and the setMarkTimeAttribute doesn't work here
            $status->update(['mark_time' => $markTime->getTimeStamp()]);
        }

        if ($this->topic_last_view_time < $markTime) {
            $this->topic_last_view_time = $markTime;
            $this->save();
        }
    }

    public function isIssue()
    {
        return in_array($this->forum_id, config('osu.forum.help_forum_ids'), true);
    }

    public function refreshLastPostCache($post = null)
    {
        DB::transaction(function () use ($post) {
            if ($post === null) {
                $post = $this->posts()->orderBy('post_id', 'desc')->first();
            }

            if ($post === null) {
                $this->update([
                    'topic_last_post_id' => null,
                    'topic_last_poster_id' => null,
                    'topic_last_poster_name' => null,
                    'topic_last_poster_colour' => null,
                    'topic_last_post_time' => null,
                ]);
            } elseif ($this->topic_last_post_id !== $post->post_id) {
                $this->update([
                    'topic_last_post_id' => $post->post_id,
                    'topic_last_poster_id' => $post->user->user_id,
                    'topic_last_poster_name' => $post->user->username,
                    'topic_last_poster_colour' => $post->user->user_colour,
                    'topic_last_post_time' => $post->post_time,
                ]);
            }
        });
    }
}
