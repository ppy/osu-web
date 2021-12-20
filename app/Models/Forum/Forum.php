<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Models\User;
use Carbon\Carbon;

/**
 * @property bool $allow_topic_covers
 * @property ForumCover $cover
 * @property int $display_on_index
 * @property int $enable_icons
 * @property bool $enable_indexing
 * @property int $enable_prune
 * @property bool $enable_sigs
 * @property string $forum_desc
 * @property string $forum_desc_bitfield
 * @property int $forum_desc_options
 * @property string $forum_desc_uid
 * @property int $forum_flags
 * @property int $forum_id
 * @property string $forum_image
 * @property int $forum_last_post_id
 * @property string $forum_last_post_subject
 * @property int $forum_last_post_time
 * @property string $forum_last_poster_colour
 * @property int $forum_last_poster_id
 * @property string $forum_last_poster_name
 * @property string $forum_link
 * @property string $forum_name
 * @property mixed $forum_parents
 * @property string $forum_password
 * @property int $forum_posts
 * @property string $forum_rules
 * @property string $forum_rules_bitfield
 * @property string $forum_rules_link
 * @property int $forum_rules_options
 * @property string $forum_rules_uid
 * @property int $forum_status
 * @property int $forum_style
 * @property int $forum_topics
 * @property int $forum_topics_per_page
 * @property int $forum_topics_real
 * @property int $forum_type
 * @property Post $lastPost
 * @property int $left_id
 * @property array|null $moderator_groups
 * @property static $parentForum
 * @property int $parent_id
 * @property int $prune_days
 * @property int $prune_freq
 * @property int $prune_next
 * @property int $prune_viewed
 * @property int $right_id
 * @property \Illuminate\Database\Eloquent\Collection $subforums static
 * @property \Illuminate\Database\Eloquent\Collection $topics Topic
 */
class Forum extends Model
{
    protected $table = 'phpbb_forums';
    protected $primaryKey = 'forum_id';

    protected $dates = ['forum_last_post_time'];
    protected $dateFormat = 'U';
    public $timestamps = false;

    protected $casts = [
        'allow_topic_covers' => 'boolean',
        'enable_indexing' => 'boolean',
        'enable_sigs' => 'boolean',
        'moderator_groups' => 'array',
    ];

    public static function lastTopics($forum = null)
    {
        $forumForLastTopic = static
            ::select('forum_id', 'parent_id', 'forum_parents', 'forum_last_post_id')
            ->with('lastPost.topic');

        if ($forum !== null) {
            $forumForLastTopic->whereIn('forum_id', $forum->allSubforums());
        }

        foreach ($forumForLastTopic->get() as $forum) {
            if ($forum->lastPost === null) {
                continue;
            }

            $topic = $forum->lastPost->topic;

            if ($topic === null) {
                continue;
            }

            $forumIds = array_keys($forum->forum_parents);
            $forumIds[] = $forum->getKey();

            foreach ($forumIds as $forumId) {
                if (!isset($lastTopics[$forumId]) || $topic->topic_last_post_time > $lastTopics[$forumId]->topic_last_post_time) {
                    $lastTopics[$forumId] = $topic;
                }
            }
        }

        return $lastTopics ?? [];
    }

    public static function markAllAsRead(User $user)
    {
        $user->update(['user_lastmark' => Carbon::now()]);
        ForumTrack::where('user_id', $user->getKey())->delete();
        TopicTrack::where('user_id', $user->getKey())->delete();
    }

    public function categorySlug()
    {
        return 'category-'.str_slug($this->category());
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
        return $this->hasMany(Topic::class);
    }

    public function parentForum()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function subforums()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('left_id');
    }

    public function lastPost()
    {
        return $this->belongsTo(Post::class, 'forum_last_post_id', 'post_id');
    }

    public function cover()
    {
        return $this->hasOne(ForumCover::class);
    }

    public function scopeDisplayList($query)
    {
        $query->orderBy('left_id');
    }

    public function setForumParentsAttribute($value)
    {
        $this->attributes['forum_parents'] = $value === null || count($value) === 0 ? '' : serialize($value);
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

        if (!present($value) && $this->parentForum !== null) {
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
        $id = config('osu.forum.feature_forum_id');

        return $this->forum_id === $id || isset($this->forum_parents[$id]);
    }

    public function isHelpForum()
    {
        return $this->forum_id === config('osu.forum.help_forum_id');
    }

    public function topicsAdded($count)
    {
        $this->getConnection()->transaction(function () use ($count) {
            $this->update([
                'forum_topics' => db_unsigned_increment('forum_topics', $count),
                'forum_topics_real' => db_unsigned_increment('forum_topics_real', $count),
            ]);
        });
    }

    public function postsAdded($count)
    {
        $this->getConnection()->transaction(function () use ($count) {
            $this->fill([
                'forum_posts' => db_unsigned_increment('forum_posts', $count),
            ]);
            $this->setLastPostCache();

            $this->save();
        });
    }

    public function refreshCache()
    {
        $this->getConnection()->transaction(function () {
            $this->setTopicsCountCache();
            $this->setPostCountCache();
            $this->setLastPostCache();

            $this->saveOrExplode();
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

    public function setPostCountCache()
    {
        $postCount = $this->forum_topics;
        $postCount += $this->topics()->sum('topic_replies');

        $this->forum_posts = $postCount;
    }

    public function setLastPostCache()
    {
        $lastTopic = Topic
            ::whereIn('forum_id', $this->allSubforums())
            ->orderBy('topic_last_post_time', 'DESC')
            ->first();

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

    public function markAsRead(User $user, bool $recursive = false)
    {
        $forumIds = [$this->getKey()];

        if ($recursive) {
            $forums = static::all();

            foreach ($forums as $forum) {
                if (isset($forum->forum_parents[$this->getKey()])) {
                    $forumIds[] = $forum->getKey();
                }
            }
        }

        $this->getConnection()->transaction(function () use ($forumIds, $user) {
            foreach ($forumIds as $forumId) {
                $forumTrack = ForumTrack::firstOrNew([
                    'user_id' => $user->getKey(),
                    'forum_id' => $forumId,
                ]);
                $forumTrack->mark_time = Carbon::now();
                $forumTrack->save();
            }

            TopicTrack::where('user_id', $user->getKey())->whereIn('forum_id', $forumIds)->delete();
        });
    }

    public function toMetaDescription()
    {
        $stack = [osu_trans('forum.title')];
        foreach ($this->forum_parents as $forumId => $forumData) {
            $stack[] = $forumData[0];
        }

        $stack[] = $this->forum_name;

        return implode(' » ', $stack);
    }
}
