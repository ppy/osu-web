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

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    const STATUS_LOCKED = 1;
    const STATUS_UNLOCKED = 0;
    const DEFAULT_ORDER_COLUMN = 'topic_last_post_time';

    protected $table = 'phpbb_topics';
    protected $primaryKey = 'topic_id';
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = ['topic_last_view_time', 'topic_last_post_time'];
    protected $dateFormat = 'U';

    private $postsCount;

    private $issueTypes = 'resolved|invalid|duplicate|confirmed';

    protected $casts = [
        'topic_approved' => 'boolean',
    ];

    public static function createNew($params)
    {
        $params += [
            'forum' => null,
            'title' => null,
            'poster' => null,
            'body' => null,
            'notifyReplies' => null,
            'cover' => null,
        ];
        extract($params);

        $topic = new static([
            'forum_id' => $forum->forum_id,
            'topic_time' => time(),
            'topic_title' => $title,
            'topic_poster' => $poster->user_id,
            'topic_first_poster_name' => $poster->username,
            'topic_first_poster_colour' => $poster->user_colour,
        ]);

        DB::transaction(function () use ($topic, $forum, $title, $poster, $body, $notifyReplies, $cover) {
            $topic->save();
            $topic->addPost($poster, $body, $notifyReplies);

            if ($cover !== null) {
                $cover->topic()->associate($topic);
                $cover->save();
            }
        });

        return $topic->fresh();
    }

    public function addPost($poster, $body, $notifyReplies)
    {
        DB::transaction(function () use ($poster, $body, $notifyReplies) {
            $post = new Post([
                'post_text' => $body,
                'post_username' => $poster->username,
                'poster_id' => $poster->user_id,
                'forum_id' => $this->forum_id,
                'post_time' => Carbon::now(),
            ]);

            $this->posts()->save($post);

            $this->refreshCache();

            if ($this->forum !== null) {
                $this->forum->refreshCache();
            }

            if ($post->user !== null) {
                $post->user->refreshForumCache($this->forum, 1);
            }
        });

        return true;
    }

    public function removePost($post, $user = null)
    {
        DB::transaction(function () use ($post, $user) {
            $post->delete();

            if ($this->posts()->exists() === true) {
                $this->refreshCache();
            } else {
                $this->deleteWithCover();
            }

            if ($this->forum !== null) {
                $this->forum->refreshCache();
            }

            if ($post->user !== null) {
                $post->user->refreshForumCache($this->forum, -1);
            }

            if ($user !== null && $user->user_id !== $post->poster_id) {
                Log::logModerateForumPost('LOG_DELETE_POST', $post);
            }
        });

        return true;
    }

    public function moveTo($destinationForum)
    {
        if ($this->forum_id === $destinationForum->forum_id) {
            return true;
        }

        if (!$this->forum->isOpen()) {
            return false;
        }

        return DB::transaction(function () use ($destinationForum) {
            $originForum = $this->forum;
            $this->forum()->associate($destinationForum);
            $this->save();

            $this->posts()->update(['forum_id' => $destinationForum->forum_id]);
            $this->logs()->update(['forum_id' => $destinationForum->forum_id]);
            $this->userTracks()->update(['forum_id' => $destinationForum->forum_id]);

            if ($originForum !== null) {
                $originForum->refreshCache();
            }

            if ($this->forum !== null) {
                $this->forum->refreshCache();
            }

            $users = User::whereIn('user_id', model_pluck($this->posts(), 'poster_id'))->get();

            foreach ($users as $user) {
                $user->refreshForumCache();
            }

            Log::logModerateForumTopicMove($this, $originForum);

            return true;
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function cover()
    {
        return $this->hasOne(TopicCover::class);
    }

    public function userTracks()
    {
        return $this->hasMany(TopicTrack::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function featureVotes()
    {
        return $this->hasMany(FeatureVote::class);
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

        return array_map('strtolower', $issues[1]);
    }

    public function scopePinned($query)
    {
        return $query->where('topic_type', '<>', 0);
    }

    public function scopeNormal($query)
    {
        return $query->where('topic_type', 0);
    }

    public function scopeWithReplies($query, $withReplies)
    {
        switch ($withReplies) {
            case 'only':
                $query->where('topic_replies_real', '<>', 0);
                break;
            case 'none':
                $query->where('topic_replies_real', 0);
                break;
        }
    }

    public function scopePresetSort($query, $sort)
    {
        switch ($sort[0] ?? null) {
            case 'feature-votes':
                $sortField = 'osu_starpriority';
                break;
        }

        $sortField ?? ($sortField = static::DEFAULT_ORDER_COLUMN);

        switch ($sort[1] ?? null) {
            case 'asc':
                $sortOrder = $sort[1];
                break;
        }

        $sortOrder ?? ($sortOrder = 'desc');

        $query->orderBy($sortField, $sortOrder);

        if ($sortField !== static::DEFAULT_ORDER_COLUMN) {
            $query->orderBy(static::DEFAULT_ORDER_COLUMN, 'desc');
        }
    }

    public function scopeRecent($query, $params = null)
    {
        $sort = $params['sort'] ?? null;
        $withReplies = $params['withReplies'] ?? null;

        $query->withReplies($withReplies);
        $query->presetSort($sort);
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
        $postIds = $sortedPosts->map(function ($p) {
            return $p->post_id;
        });

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
        // not checking STATUS_LOCK because there's another
        // state (STATUS_MOVED) which isn't handled yet.
        return $this->topic_status !== static::STATUS_UNLOCKED;
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

    public function refreshCache()
    {
        DB::transaction(function () {
            $this->setPostsCountCache();
            $this->setFirstPostCache();
            $this->setLastPostCache();

            $this->save();
        });
    }

    public function setPostsCountCache()
    {
        $this->topic_replies = -1 + $this->posts()->where('post_approved', true)->count();
        $this->topic_replies_real = -1 + $this->posts()->count();
    }

    public function setFirstPostCache()
    {
        $firstPost = $this->posts()->first();

        if ($firstPost === null) {
            $this->topic_first_post_id = null;
            $this->topic_poster = null;
            $this->topic_first_poster_name = null;
            $this->topic_first_poster_colour = null;
        } else {
            $this->topic_first_post_id = $firstPost->post_id;

            if ($firstPost->user === null) {
                $this->topic_poster = null;
                $this->topic_first_poster_name = null;
                $this->topic_first_poster_colour = null;
            } else {
                $this->topic_poster = $firstPost->user->user_id;
                $this->topic_first_poster_name = $firstPost->user->username;
                $this->topic_first_poster_colour = $firstPost->user->user_colour;
            }
        }
    }

    public function setLastPostCache()
    {
        $lastPost = $this->posts()->last()->first();

        if ($lastPost === null) {
            $this->topic_last_post_id = null;
            $this->topic_last_post_time = null;

            $this->topic_last_poster_id = null;
            $this->topic_last_poster_name = null;
            $this->topic_last_poster_colour = null;
        } else {
            $this->topic_last_post_id = $lastPost->post_id;
            $this->topic_last_post_time = $lastPost->post_time;

            if ($lastPost->user === null) {
                $this->topic_last_poster_id = null;
                $this->topic_last_poster_name = null;
                $this->topic_last_poster_colour = null;
            } else {
                $this->topic_last_poster_id = $lastPost->user->user_id;
                $this->topic_last_poster_name = $lastPost->user->username;
                $this->topic_last_poster_colour = $lastPost->user->user_colour;
            }
        }
    }

    public function setCover($path, $user)
    {
        if ($this->cover === null) {
            TopicCover::upload($path, $user, $this);
        } else {
            $this->cover->storeFile($path);
            $this->cover->user()->associate($user);
            $this->cover->save();
        }

        return $this->fresh();
    }

    public function lock($lock = true)
    {
        DB::transaction(function () use ($lock) {
            if ($lock === true) {
                $newStatus = static::STATUS_LOCKED;
                $logOperation = 'LOG_LOCK';
            } else {
                $newStatus = static::STATUS_UNLOCKED;
                $logOperation = 'LOG_UNLOCK';
            }

            $this->update(['topic_status' => $newStatus]);

            Log::logModerateForumTopic($logOperation, $this);
        });
    }

    public function deleteWithCover()
    {
        if ($this->cover !== null) {
            $this->cover->deleteWithFile();
        }

        $this->delete();
    }

    public function isFeatureTopic()
    {
        return $this->forum->isFeatureForum();
    }
}
