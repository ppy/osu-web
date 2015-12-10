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

use DB;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'phpbb_forums';
    protected $primaryKey = 'forum_id';
    protected $guarded = [];

    protected $dates = ['forum_last_post_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    private $_lastTopic = null;

    protected $casts = [
        'enable_sigs' => 'boolean',
        'forum_id' => 'integer',
        'forum_last_post_id' => 'integer',
        'forum_type' => 'integer',
        'parent_id' => 'integer',
    ];

    public function categorySlug()
    {
        return 'category-'.str_slug($this->category());
    }

    public function lastTopic()
    {
        if ($this->_lastTopic === null) {
            $this->_lastTopic = [Topic::whereIn('forum_id', $this->allSubforums())->orderBy('topic_last_post_time', 'desc')->first()];
        }

        return $this->_lastTopic[0];
    }

    public function allSubforums($forum_ids = null, $new_forum_ids = null)
    {
        if ($forum_ids === null) {
            $forum_ids = $new_forum_ids = [$this->forum_id];
        }
        $new_forum_ids = static::whereIn('parent_id', $new_forum_ids)->lists('forum_id')->all();

        $new_forum_ids = array_map(function ($value) { return intval($value); }, $new_forum_ids);
        $forum_ids = array_merge($forum_ids, $new_forum_ids);

        if (count($new_forum_ids) === 0) {
            return $forum_ids;
        } else {
            return $this->allSubforums($forum_ids, $new_forum_ids);
        }
    }

    public function categoryId()
    {
        if ($this->forum_parents) {
            return array_keys($this->forum_parents)[0];
        } else {
            return $this->forum_id;
        }
    }

    public function category()
    {
        if ($this->forum_parents) {
            return array_values($this->forum_parents)[0][0];
        } else {
            return $this->forum_name;
        }
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function parentForum()
    {
        return $this->belongsTo(Forum::class, 'parent_id');
    }

    public function subforums()
    {
        return $this->hasMany(Forum::class, 'parent_id')->orderBy('left_id');
    }

    public function cover()
    {
        return $this->hasOne(ForumCover::class);
    }

    public function getForumParentsAttribute($value)
    {
        $buf = unserialize($value);
        if (!$buf) {
            return [];
        } else {
            return $buf;
        }
    }

    public function canBeViewedBy($user)
    {
        if ($this->categoryId() !== config('osu.forum.admin_forum_id')) {
            return true;
        }

        return $user !== null && $user->isAdmin() === true;
    }

    public function canHavePost()
    {
        return $this->forum_type === 1;
    }

    public function refreshCache()
    {
        DB::transaction(function () {
            $this->refreshTopicsCountCache();
            $this->refreshPostsCountCache();
            $this->refreshLastPostCache();
        });
    }

    public function refreshTopicsCountCache()
    {
        DB::transaction(function () {
            $topicsCount = $this->topics()->count();
            $topicsCount += $this->subforums()->sum('forum_topics');

            $this->update(['forum_topics' => $topicsCount]);

            if ($this->parentForum !== null) {
                return $this->parentForum->refreshTopicsCountCache();
            }
        });
    }

    public function refreshPostsCountCache()
    {
        DB::transaction(function () {
            $postsCount = $this->forum_topics;
            $postsCount += $this->topics()->sum('topic_replies_real');
            $postsCount += $this->subforums()->sum('forum_posts');

            $this->update(['forum_posts' => $postsCount]);

            if ($this->parentForum !== null) {
                return $this->parentForum->refreshPostsCountCache();
            }
        });
    }

    public function refreshLastPostCache($post = null)
    {
        DB::transaction(function () use ($post) {
            if ($post === null && $this->lastTopic() !== null) {
                $post = $this->lastTopic()->posts()->orderBy('post_id', 'desc')->first();
            }

            if ($post === null) {
                $this->update([
                    'forum_last_post_id' => null,
                    'forum_last_poster_id' => null,
                    'forum_last_post_subject' => null,
                    'forum_last_post_time' => null,
                    'forum_last_poster_name' => null,
                    'forum_last_poster_colour' => null,
                ]);
            } elseif ($this->forum_last_post_id !== $post->post_id) {
                $this->update([
                    'forum_last_post_id' => $post->post_id,
                    'forum_last_poster_id' => $post->user->user_id,
                    'forum_last_post_subject' => $post->topic->topic_title,
                    'forum_last_post_time' => $post->post_time,
                    'forum_last_poster_name' => $post->user->username,
                    'forum_last_poster_colour' => $post->user->user_colour,
                ]);
            }

            if ($this->parent !== null) {
                $this->parent->refreshLastPostCache($post);
            }
        });
    }
}
