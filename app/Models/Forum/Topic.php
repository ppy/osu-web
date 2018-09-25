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

use App\Exceptions\ModelNotSavedException;
use App\Jobs\EsIndexDocument;
use App\Jobs\UpdateUserForumCache;
use App\Libraries\BBCodeForDB;
use App\Libraries\Transactions\AfterCommit;
use App\Models\Beatmapset;
use App\Models\Elasticsearch;
use App\Models\Log;
use App\Models\User;
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

class Topic extends Model implements AfterCommit
{
    use Elasticsearch\TopicTrait, SoftDeletes, Validatable;

    const DEFAULT_ORDER_COLUMN = 'topic_last_post_time';

    const STATUS_LOCKED = 1;
    const STATUS_UNLOCKED = 0;

    const TYPES = [
        'normal' => 0,
        'sticky' => 1,
        'announcement' => 2,
    ];

    const ISSUE_TAGS = [
        'added',
        'assigned',
        'confirmed',
        'duplicate',
        'invalid',
        'resolved',
    ];

    const MAX_FIELD_LENGTHS = [
        'topic_title' => 100,
    ];

    protected $table = 'phpbb_topics';
    protected $primaryKey = 'topic_id';

    public $timestamps = false;

    private $postsCount;
    private $deletedPostsCount;
    private $_vote;
    private $_poll;
    private $_issueTags;

    protected $casts = [
        'poll_vote_change' => 'boolean',
        'topic_approved' => 'boolean',
    ];

    public static function createNew($forum, $params, $poll = null)
    {
        $topic = new static([
            'topic_time' => Carbon::now(),
            'topic_title' => $params['title'] ?? null,
            'topic_poster' => $params['user']->user_id,
            'topic_first_poster_name' => $params['user']->username,
            'topic_first_poster_colour' => $params['user']->user_colour,
        ]);
        $topic->forum()->associate($forum);

        $topic->getConnection()->transaction(function () use ($forum, $topic, $params, $poll) {
            $topic->saveOrExplode();
            $topic->addPostOrExplode($params['user'], $params['body']);

            if ($poll !== null) {
                $topic->poll($poll)->save();
            }

            if (($params['cover'] ?? null) !== null) {
                $params['cover']->topic()->associate($topic);
                $params['cover']->save();
            }
        });

        return $topic->fresh();
    }

    public function addPostOrExplode($poster, $body)
    {
        $post = new Post([
            'post_text' => $body,
            'post_username' => $poster->username,
            'poster_id' => $poster->user_id,
            'forum_id' => $this->forum_id,
            'topic_id' => $this->getKey(),
            'post_time' => Carbon::now(),
        ]);

        $this->getConnection()->transaction(function () use ($post) {
            $post->saveOrExplode();

            $this->postsAdded(1);
            optional($this->forum)->postsAdded(1);

            if ($post->user !== null) {
                $post->user->refreshForumCache($this->forum, 1);
            }
        });

        return $post;
    }

    public function removePostOrExplode($post)
    {
        $this->validationErrors()->reset();

        return $this->getConnection()->transaction(function () use ($post) {
            if ($post->delete() === false) {
                $message = $post->validationErrors()->toSentence();
                $this->validationErrors()->addTranslated('post', $message);

                throw new ModelNotSavedException($message);
            }

            if ($this->posts()->exists() === true) {
                $this->postsAdded(-1);
            } else {
                $this->delete();
                optional($this->forum)->topicsAdded(-1);
            }

            optional($this->forum)->postsAdded(-1);

            if ($post->user !== null) {
                $post->user->refreshForumCache($this->forum, -1);
            }

            return true;
        });
    }

    public function restorePost($post)
    {
        $this->getConnection()->transaction(function () use ($post) {
            $post->restore();

            $this->postsAdded(1);
            optional($this->forum)->postsAdded(1);

            if ($this->trashed()) {
                $this->restore();
            }

            optional($post->user)->refreshForumCache($this->forum, 1);
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

        return $this->getConnection()->transaction(function () use ($destinationForum) {
            $originForum = $this->forum;
            $this->forum()->associate($destinationForum);
            $this->save();

            $this->posts()->withTrashed()->update(['forum_id' => $this->forum_id]);

            $this->logs()->update(['forum_id' => $destinationForum->forum_id]);
            $this->userTracks()->update(['forum_id' => $destinationForum->forum_id]);

            $visiblePostsCount = $this->posts()->count();
            optional($originForum)->topicsAdded(-1);
            optional($originForum)->postsAdded($visiblePostsCount * -1);
            optional($this->forum)->topicsAdded(1);
            optional($this->forum)->postsAdded($visiblePostsCount);

            $this
                ->posts()
                ->withTrashed()
                // this relies on dispatcher always reloading the model
                ->select(['poster_id', 'post_id'])
                ->each(function ($post) {
                    dispatch(new UpdateUserForumCache($post->poster_id));
                    dispatch(new EsIndexDocument($post));
                });

            return true;
        });
    }

    public static function typeStr($typeInt)
    {
        return array_search_null($typeInt, static::TYPES) ?? null;
    }

    public static function typeInt($typeIntOrStr)
    {
        if (is_int($typeIntOrStr)) {
            if (in_array($typeIntOrStr, static::TYPES, true)) {
                return $typeIntOrStr;
            }
        } else {
            return static::TYPES[$typeIntOrStr] ?? null;
        }
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.topic';
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'topic_id', 'thread_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function cover()
    {
        return $this->hasOne(TopicCover::class, 'topic_id');
    }

    public function userTracks()
    {
        return $this->hasMany(TopicTrack::class, 'topic_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'topic_id');
    }

    public function featureVotes()
    {
        return $this->hasMany(FeatureVote::class, 'topic_id');
    }

    public function pollOptions()
    {
        return $this->hasMany(PollOption::class, 'topic_id');
    }

    public function pollVotes()
    {
        return $this->hasMany(PollVote::class, 'topic_id');
    }

    public function watches()
    {
        return $this->hasMany(TopicWatch::class, 'topic_id');
    }

    public function getPollLastVoteAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setPollLastVoteAttribute($value)
    {
        $this->attributes['poll_last_vote'] = get_timestamp_or_zero($value);
    }

    public function getPollStartAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setPollStartAttribute($value)
    {
        $this->attributes['poll_start'] = get_timestamp_or_zero($value);
    }

    public function getTopicLastPostTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setTopicLastPostTimeAttribute($value)
    {
        $this->attributes['topic_last_post_time'] = get_timestamp_or_zero($value);
    }

    public function getTopicLastViewTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setTopicLastViewTimeAttribute($value)
    {
        $this->attributes['topic_last_view_time'] = get_timestamp_or_zero($value);
    }

    public function getTopicTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setTopicTimeAttribute($value)
    {
        $this->attributes['topic_time'] = get_timestamp_or_zero($value);
    }

    public function getTopicFirstPosterColourAttribute($value)
    {
        if (present($value)) {
            return "#{$value}";
        }
    }

    public function setTopicFirstPosterColourAttribute($value)
    {
        // also functions for casting null to string
        $this->attributes['topic_first_poster_colour'] = ltrim($value, '#');
    }

    public function getTopicLastPosterColourAttribute($value)
    {
        if (present($value)) {
            return "#{$value}";
        }
    }

    public function setTopicLastPosterColourAttribute($value)
    {
        // also functions for casting null to string
        $this->attributes['topic_last_poster_colour'] = ltrim($value, '#');
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->getConnection()->transaction(function () use ($options) {
            // creating new topic
            if (!$this->exists && $this->forum !== null) {
                $this->forum->topicsAdded(1);
            }

            // restoring topic
            if ($this->isDirty('deleted_at') && $this->deleted_at === null) {
                $this->forum->topicsAdded(1);
            }

            return parent::save($options);
        });
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->isDirty('topic_title') && !present($this->topic_title)) {
            $this->validationErrors()->add('topic_title', 'required');
        }

        foreach (static::MAX_FIELD_LENGTHS as $field => $limit) {
            if ($this->isDirty($field)) {
                $val = $this->$field;

                if (mb_strlen($val) > $limit) {
                    $this->validationErrors()->add($field, 'too_long', ['limit' => $limit]);
                }
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function titleNormalized()
    {
        if (!$this->isIssue()) {
            return $this->topic_title;
        }

        $title = $this->topic_title;

        foreach (static::ISSUE_TAGS as $tag) {
            $title = str_replace("[{$tag}]", '', $title);
        }

        return trim($title);
    }

    public function issueTags()
    {
        if (!$this->isIssue()) {
            return [];
        }

        if ($this->_issueTags === null) {
            $this->_issueTags = [];
            foreach (static::ISSUE_TAGS as $tag) {
                if ($this->hasIssueTag($tag)) {
                    $this->_issueTags[] = $tag;
                }
            }
        }

        return $this->_issueTags;
    }

    public function scopePinned($query)
    {
        return $query->where('topic_type', '<>', static::typeInt('normal'));
    }

    public function scopeNormal($query)
    {
        return $query->where('topic_type', '=', static::typeInt('normal'));
    }

    public function scopeShowDeleted($query, $showDeleted)
    {
        if ($showDeleted) {
            $query->withTrashed();
        }
    }

    public function scopeWatchedByUser($query, $user)
    {
        $forumIds = Authorize::aclGetAllowedForums($user, 'f_read');

        return $query
            ->with('forum')
            ->whereIn('forum_id', $forumIds)
            ->whereIn(
                'topic_id',
                TopicWatch::where('user_id', $user->user_id)->select('topic_id')
            )
            ->orderBy('topic_last_post_time', 'DESC');
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

    public function setPollTitleAttribute($value)
    {
        $this->attributes['poll_title'] = (new BBCodeForDB($value))->generate();
    }

    public function pollTitleHTML()
    {
        return bbcode($this->poll_title, $this->posts()->withTrashed()->first()->bbcode_uid);
    }

    public function pollEnd()
    {
        if ($this->poll_start !== null && $this->poll_length !== 0) {
            return $this->poll_start->copy()->addSeconds($this->poll_length);
        }
    }

    public function postsCount()
    {
        if ($this->postsCount === null) {
            $this->postsCount = $this->posts()->count();
        }

        return $this->postsCount;
    }

    public function deletedPostsCount()
    {
        if ($this->deletedPostsCount === null) {
            $this->deletedPostsCount = $this->posts()->onlyTrashed()->count();
        }

        return $this->deletedPostsCount;
    }

    public function isLocked()
    {
        // not checking STATUS_LOCK because there's another
        // state (STATUS_MOVED) which isn't handled yet.
        return $this->topic_status !== static::STATUS_UNLOCKED;
    }

    public function isActive()
    {
        return $this->topic_last_post_time > Carbon::now()->subMonths(config('osu.forum.necropost_months'));
    }

    public function markRead($user, $markTime)
    {
        if ($user === null) {
            return;
        }

        DB::beginTransaction();

        $status = TopicTrack
            ::where([
                'user_id' => $user->user_id,
                'topic_id' => $this->topic_id,
            ])
            ->first();

        if ($status === null) {
            // first time seeing the topic, create tracking entry
            // and increment views count
            try {
                TopicTrack::create([
                    'user_id' => $user->user_id,
                    'topic_id' => $this->topic_id,
                    'forum_id' => $this->forum_id,
                    'mark_time' => $markTime,
                ]);
            } catch (QueryException $ex) {
                DB::rollback();

                // Duplicate entry.
                // Retry, hoping $status now contains something.
                if (is_sql_unique_exception($ex)) {
                    return $this->markRead($user, $markTime);
                }

                throw $ex;
            }

            $this->increment('topic_views');
        } elseif ($status->mark_time < $markTime) {
            $status->update(['mark_time' => $markTime]);
        }

        if ($this->topic_last_view_time < $markTime) {
            $this->topic_last_view_time = $markTime;
            $this->save();
        }

        DB::commit();
    }

    public function isIssue()
    {
        return in_array($this->forum_id, config('osu.forum.help_forum_ids'), true);
    }

    public function postsAdded($count)
    {
        $this->getConnection()->transaction(function () use ($count) {
            $this->fill([
                'topic_replies' => db_unsigned_increment('topic_replies', $count),
                'topic_replies_real' => db_unsigned_increment('topic_replies_real', $count),
            ]);
            $this->setFirstPostCache();
            $this->setLastPostCache();

            $this->save();
        });
    }

    public function refreshCache()
    {
        $this->getConnection()->transaction(function () {
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
            $this->topic_first_post_id = 0;
            $this->topic_poster = '';
            $this->topic_first_poster_name = '';
            $this->topic_first_poster_colour = '';
        } else {
            $this->topic_first_post_id = $firstPost->post_id;

            if ($firstPost->user === null) {
                $this->topic_poster = 0;
                $this->topic_first_poster_name = '';
                $this->topic_first_poster_colour = '';
            } else {
                $this->topic_poster = $firstPost->user->user_id;
                $this->topic_first_poster_name = $firstPost->user->username;
                $this->topic_first_poster_colour = $firstPost->user->user_colour;
            }
        }
    }

    public function setLastPostCache()
    {
        $lastPost = $this->posts()->last();

        if ($lastPost === null) {
            $this->topic_last_post_id = 0;
            $this->topic_last_post_time = null;

            $this->topic_last_poster_id = 0;
            $this->topic_last_poster_name = '';
            $this->topic_last_poster_colour = '';
        } else {
            $this->topic_last_post_id = $lastPost->post_id;
            $this->topic_last_post_time = $lastPost->post_time;

            if ($lastPost->user === null) {
                $this->topic_last_poster_id = 0;
                $this->topic_last_poster_name = '';
                $this->topic_last_poster_colour = '';
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
        $this->update([
            'topic_status' => $lock ? static::STATUS_LOCKED : static::STATUS_UNLOCKED,
        ]);
    }

    public function pin($pin)
    {
        $this->update([
            'topic_type' => static::typeInt($pin) ?? static::typeInt('normal'),
        ]);
    }

    public function deleteWithDependencies()
    {
        if ($this->cover !== null) {
            $this->cover->deleteWithFile();
        }

        $this->pollOptions()->delete();
        $this->pollVotes()->delete();
        $this->userTracks()->delete();

        // FIXME: returning used stars?
        $this->featureVotes()->delete();

        $this->delete();
    }

    public function isDoublePostBy(User $user)
    {
        if ($user === null) {
            return false;
        }
        if ($user->user_id !== $this->topic_last_poster_id) {
            return false;
        }
        if ($user->user_id === $this->topic_poster) {
            $minHours = config('osu.forum.double_post_time.author');
        } else {
            $minHours = config('osu.forum.double_post_time.normal');
        }

        return $this->topic_last_post_time > Carbon::now()->subHours($minHours);
    }

    public function isFeatureTopic()
    {
        return $this->forum->isFeatureForum();
    }

    public function poll($poll = null)
    {
        if ($this->_poll === null) {
            if ($poll === null) {
                $poll = new TopicPoll();
            }
            $this->_poll = $poll->setTopic($this);
        }

        return $this->_poll;
    }

    public function vote()
    {
        if ($this->_vote === null) {
            $this->_vote = new TopicVote($this);
        }

        return $this->_vote;
    }

    public function setIssueTag($tag)
    {
        $this->topic_type = static::typeInt($tag === 'confirmed' ? 'sticky' : 'normal');

        if (!$this->hasIssueTag($tag)) {
            $this->topic_title = "[{$tag}] {$this->topic_title}";
        }

        $this->save();
    }

    public function unsetIssueTag($tag)
    {
        $this->topic_type = static::typeInt($tag === 'resolved' ? 'sticky' : 'normal');

        $this->topic_title = preg_replace(
            '/  +/',
            ' ',
            trim(str_replace("[{$tag}]", '', $this->topic_title))
        );

        $this->save();
    }

    public function hasIssueTag($tag)
    {
        return strpos($this->topic_title, "[{$tag}]") !== false;
    }

    public function toMetaDescription()
    {
        return "{$this->forum->toMetaDescription()} » {$this->topic_title}";
    }

    public function afterCommit()
    {
        dispatch(new EsIndexDocument($this));
    }
}
