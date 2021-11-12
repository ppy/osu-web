<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Exceptions\ModelNotSavedException;
use App\Jobs\EsIndexDocument;
use App\Jobs\MarkNotificationsRead;
use App\Libraries\BBCodeForDB;
use App\Libraries\BBCodeFromDB;
use App\Libraries\Elasticsearch\Indexable;
use App\Libraries\Transactions\AfterCommit;
use App\Models\Beatmapset;
use App\Models\DeletedUser;
use App\Models\Traits;
use App\Models\User;
use App\Traits\Validatable;
use App\Traits\WithDbCursorHelper;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $bbcode_bitfield
 * @property string $bbcode_uid
 * @property mixed $body_raw
 * @property \Carbon\Carbon|null $deleted_at
 * @property int $enable_bbcode
 * @property int $enable_magic_url
 * @property int $enable_sig
 * @property int $enable_smilies
 * @property Forum $forum
 * @property int $forum_id
 * @property int $icon_id
 * @property User $lastEditor
 * @property int $osu_kudosobtained
 * @property bool $post_approved
 * @property int $post_attachment
 * @property int $post_edit_count
 * @property bool $post_edit_locked
 * @property string $post_edit_reason
 * @property int $post_edit_time
 * @property int $post_edit_user
 * @property int $post_id
 * @property mixed $post_position
 * @property int $post_postcount
 * @property int $post_reported
 * @property string $post_subject
 * @property mixed $post_text
 * @property int $post_time
 * @property string $post_username
 * @property int $poster_id
 * @property string $poster_ip
 * @property mixed $search_content
 * @property Topic $topic
 * @property int $topic_id
 * @property User $user
 */
class Post extends Model implements AfterCommit, Indexable
{
    use Traits\Es\ForumPostSearch, Traits\Reportable, Validatable, WithDbCursorHelper;
    use SoftDeletes {
        restore as private origRestore;
    }

    const SORTS = [
        'id_asc' => [
            ['column' => 'post_id', 'columnInput' => 'id', 'order' => 'ASC'],
        ],
        'id_desc' => [
            ['column' => 'post_id', 'columnInput' => 'id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'id_asc';

    protected $table = 'phpbb_posts';
    protected $primaryKey = 'post_id';

    public $timestamps = false;

    protected $casts = [
        'post_edit_locked' => 'boolean',
        'post_approved' => 'boolean',
    ];

    private $normalizedUsers = [];

    private $skipBeatmapPostRestrictions = false;
    private $skipBodyPresenceCheck = false;

    public static function createNew($topic, $poster, $body, $isReply = true)
    {
        $post = (new static([
            'post_text' => $body,
            'post_username' => $poster->username,
            'poster_id' => $poster->user_id,
            'forum_id' => $topic->forum_id,
            'topic_id' => $topic->getKey(),
            'post_time' => now(),
        ]))->setRelation('topic', $topic)
        ->setRelation('forum', $topic->forum);

        $post->getConnection()->transaction(function () use ($topic, $post, $isReply) {
            $post->saveOrExplode();

            $post->topic->postsAdded($isReply ? 1 : 0);
            $post->forum->postsAdded(1);

            if ($post->user !== null) {
                $post->user->refreshForumCache($post->forum, 1);
                $post->user->refresh();
            }
        });

        return $post;
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id', 'forum_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'poster_id', 'user_id');
    }

    public function lastEditor()
    {
        return $this->belongsTo(User::class, 'post_edit_user', 'user_id');
    }

    public function setPostTextAttribute($value)
    {
        if ($value === $this->bodyRaw) {
            return;
        }

        $bbcode = new BBCodeForDB($value);
        $this->attributes['post_text'] = $bbcode->generate();
        $this->attributes['bbcode_uid'] = $bbcode->uid;
        $this->attributes['bbcode_bitfield'] = $bbcode->bitfield;
    }

    public function getPostEditUserAttribute($value)
    {
        if ($value !== 0) {
            return $value;
        }
    }

    public function setPostTimeAttribute($value)
    {
        $this->attributes['post_time'] = get_timestamp_or_zero($value);
    }

    public function getPostTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    public function setPostEditTimeAttribute($value)
    {
        $this->attributes['post_edit_time'] = get_timestamp_or_zero($value);
    }

    public function getPostEditTimeAttribute($value)
    {
        return get_time_or_null($value);
    }

    /**
     * Gets a preview of the post_text by stripping anything that
     * looks like bbcode or html.
     *
     * @return string
     */
    public function getSearchContentAttribute()
    {
        // remove metadata
        // remove blockquotes
        // unescape html entities
        // strip remaining bbcode
        // strip any html tags left
        $text = Beatmapset::removeMetadataText($this->post_text);
        $text = BBCodeFromDB::removeBlockQuotes($text);
        $text = html_entity_decode_better($text);
        $text = BBCodeFromDB::removeBBCodeTags($text);

        return strip_tags($text);
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
                $normalizedUser->user_colour = '#ccc';
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

    public function skipBeatmapPostRestrictions()
    {
        $this->skipBeatmapPostRestrictions = true;

        return $this;
    }

    public function skipBodyPresenceCheck()
    {
        $this->skipBodyPresenceCheck = true;

        return $this;
    }

    public function delete()
    {
        if ($this->trashed()) {
            return true;
        }

        $this->validationErrors()->reset();

        // don't forget to sync with views.forum.topics._posts
        if ($this->isBeatmapsetPost()) {
            $this->validationErrors()->add('base', '.beatmapset_post_no_delete');

            return false;
        }

        if ($this->getKey() === $this->topic->topic_first_post_id) {
            $this->validationErrors()->add('post_id', '.no_delete_first_post');

            return false;
        }

        return $this->getConnection()->transaction(function () {
            if (!parent::delete()) {
                return false;
            }

            $this->topic->postsAdded(-1);
            $this->forum->postsAdded(-1);

            if ($this->user !== null) {
                $this->user->refreshForumCache($this->forum, -1);
                $this->user->refresh();
            }

            return true;
        });
    }

    public function deleteOrExplode()
    {
        if (!$this->delete()) {
            throw new ModelNotSavedException($this->validationErrors()->toSentence());
        }

        return true;
    }

    public function restore()
    {
        if (!$this->trashed()) {
            return true;
        }

        return $this->getConnection()->transaction(function () {
            if (!$this->origRestore()) {
                return false;
            }

            $this->topic->postsAdded(1);
            $this->forum->postsAdded(1);

            if ($this->user !== null) {
                $this->user->refreshForumCache($this->forum, 1);
                $this->user->refresh();
            }

            return true;
        });
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if (!$this->skipBodyPresenceCheck) {
            if (trim_unicode($this->post_text) === '') {
                $this->validationErrors()->add('post_text', 'required');
            } elseif (trim_unicode(BBCodeFromDB::removeBlockQuotes($this->post_text)) === '') {
                $this->validationErrors()->add('base', '.only_quote');
            }
        }

        if ($this->isDirty('post_text') && mb_strlen($this->body_raw) > config('osu.forum.max_post_length')) {
            $this->validationErrors()->add('post_text', 'too_long', ['limit' => config('osu.forum.max_post_length')]);
        }

        if (!$this->skipBeatmapPostRestrictions) {
            // don't forget to sync with views.forum.topics._posts
            if ($this->isBeatmapsetPost()) {
                $this->validationErrors()->add('base', '.beatmapset_post_no_edit');

                return false;
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        if (!$this->isValid()) {
            return false;
        }

        // record edit history
        if ($this->exists && $this->isDirty('post_text')) {
            $this->fill([
                'post_edit_time' => Carbon::now(),
                'post_edit_count' => DB::raw('post_edit_count + 1'),
            ]);
        }

        return parent::save($options);
    }

    // don't forget to sync with views.forum.topics._posts
    public function isBeatmapsetPost()
    {
        if ($this->topic !== null) {
            return $this->getKey() === $this->topic->topic_first_post_id &&
                $this->topic->beatmapset()->exists();
        }
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.post';
    }

    public function getBodyRawAttribute()
    {
        return bbcode_for_editor($this->post_text, $this->bbcode_uid);
    }

    public function scopeShowDeleted($query, $showDeleted)
    {
        if ($showDeleted) {
            $query->withTrashed();
        }
    }

    public function afterCommit()
    {
        if ($this->exists) {
            dispatch(new EsIndexDocument($this));
        }
    }

    public function bodyHTML($options = [])
    {
        return bbcode($this->post_text, $this->bbcode_uid, array_merge(['withGallery' => true], $options));
    }

    public function markRead($user)
    {
        if ($user === null) {
            return;
        }

        $topic = $this->topic ?? $this->topic()->withTrashed()->first();

        if ($topic === null) {
            return;
        }

        $topic->markRead($user, $this->post_time);

        // reset notification status when viewing latest post
        if ($topic->topic_last_post_id === $this->getKey()) {
            TopicWatch::lookupQuery($topic, $user)->update(['notify_status' => false]);
        }

        (new MarkNotificationsRead($this, $user))->dispatch();
    }

    public function url()
    {
        return route('forum.posts.show', $this);
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'Spam',
            'user_id' => $this->poster_id,
        ];
    }
}
