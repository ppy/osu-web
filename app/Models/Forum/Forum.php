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

use DB;

class Forum extends Model
{
    protected $table = 'phpbb_forums';
    protected $primaryKey = 'forum_id';
    protected $guarded = [];

    protected $dates = ['forum_last_post_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    private $_lastTopic = [];

    protected $casts = [
        'enable_sigs' => 'boolean',
    ];

    public function categorySlug()
    {
        return 'category-'.str_slug($this->category());
    }

    public function lastTopic($recursive = true)
    {
        $key = $recursive === true ? 'recursive' : 'current';
        if (isset($this->_lastTopic[$key]) === false) {
            $this->_lastTopic[$key] =
                Topic::whereIn('forum_id', ($recursive ? $this->allSubforums() : [$this->forum_id]))
                ->orderBy('topic_last_post_time', 'desc')
                ->first();
        }

        return $this->_lastTopic[$key];
    }

    public function allSubforums($forum_ids = null, $new_forum_ids = null)
    {
        if ($forum_ids === null) {
            $forum_ids = $new_forum_ids = [$this->forum_id];
        }
        $new_forum_ids = model_pluck(static::whereIn('parent_id', $new_forum_ids), 'forum_id');

        $new_forum_ids = array_map('intval', $new_forum_ids);
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
        return $this->hasMany(Topic::class, 'forum_id');
    }

    public function parentForum()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function subforums()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('left_id');
    }

    public function cover()
    {
        return $this->hasOne(ForumCover::class, 'forum_id');
    }

    public function scopeDisplayList($query)
    {
        $query->orderBy('left_id');
    }

    public function setForumParentsAttribute($value)
    {
        $this->attributes['forum_parents'] = presence($value) === null ? '' : serialize($value);
    }

    /**
     * Returns array which keys are id of this forum's parents and values are
     * their names and types. Sorted from topmost parent to immediate parent.
     *
     * This method isn't intended to be directly called but through Laravel's
     * attribute accessor method (in this case, `$forum->forum_parents`)
     *
     * warning: don't access this attribute (forum_parents) without selecting
     * parent_id otherwise returned value may be wrong.
     *
     * @param string $value
     * @return array
     */
    public function getForumParentsAttribute($value)
    {
        if ($this->parent_id === 0) {
            return [];
        }

        if (presence($value) === null && $this->parentForum !== null) {
            $parentsArray = $this->parentForum->forum_parents;
            $parentsArray[$this->parentForum->forum_id] = [
                $this->parentForum->forum_name,
                $this->parentForum->forum_type,
            ];

            $this->update(['forum_parents' => $parentsArray]);

            return $parentsArray;
        } else {
            return unserialize($value);
        }
    }

    public function getForumLastPosterColourAttribute($value)
    {
        if (present($value)) {
            return "#{$value}";
        }
    }

    public function setForumLastPosterColourAttribute($value)
    {
        // also functions for casting null to string
        $this->attributes['forum_last_poster_colour'] = ltrim($value, '#');
    }

    public function getForumLastPostTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setForumLastPostTimeAttribute($value)
    {
        $this->attributes['forum_last_post_time'] = get_timestamp_or_zero($value);
    }

    // feature forum shall have extra features like sorting and voting
    public function isFeatureForum()
    {
        return $this->forum_id === config('osu.forum.feature_forum_id');
    }

    public function refreshCache()
    {
        DB::transaction(function () {
            $this->setTopicsCountCache();
            $this->setPostsCountCache();
            $this->setLastPostCache();

            $this->save();
        });
    }

    public function currentDepth()
    {
        return count($this->forum_parents);
    }

    public function setTopicsCountCache()
    {
        $this->forum_topics_real = $this->topics()->count();
        $this->forum_topics = $this->topics()->where('topic_approved', true)->count();
    }

    public function setPostsCountCache()
    {
        $postsCount = $this->forum_topics;
        $postsCount += $this->topics()->sum('topic_replies');

        $this->forum_posts = $postsCount;
    }

    public function setLastPostCache()
    {
        $lastTopic = $this->lastTopic(false);

        if ($lastTopic === null) {
            $this->forum_last_post_id = 0;
            $this->forum_last_post_time = null;
            $this->forum_last_post_subject = '';
            $this->forum_last_poster_id = 0;
            $this->forum_last_poster_name = '';
            $this->forum_last_poster_colour = '';
        } else {
            $this->forum_last_post_id = $lastTopic->topic_last_post_id;
            $this->forum_last_post_time = $lastTopic->topic_last_post_time;
            $this->forum_last_post_subject = $lastTopic->topic_title;
            $this->forum_last_poster_id = $lastTopic->topic_last_poster_id;
            $this->forum_last_poster_name = $lastTopic->topic_last_poster_name;
            $this->forum_last_poster_colour = $lastTopic->topic_last_poster_colour;
        }
    }

    public function isOpen()
    {
        return $this->forum_type === 1;
    }

    public function toMetaDescription()
    {
        $stack = [trans('forum.title')];
        foreach ($this->forum_parents as $forumId => $forumData) {
            $stack[] = $forumData[0];
        }

        $stack[] = $this->forum_name;

        return implode(' » ', $stack);
    }
}
