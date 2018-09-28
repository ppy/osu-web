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

use App\Jobs\EsIndexDocument;
use App\Libraries\BBCodeForDB;
use App\Libraries\BBCodeFromDB;
use App\Libraries\Transactions\AfterCommit;
use App\Models\Beatmapset;
use App\Models\DeletedUser;
use App\Models\Elasticsearch;
use App\Models\User;
use App\Traits\Validatable;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model implements AfterCommit
{
    use Elasticsearch\PostTrait, SoftDeletes, Validatable;

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

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id', 'forum_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'topic_id');
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
        $this->validationErrors()->reset();

        // don't forget to sync with views.forum.topics._posts
        if ($this->isBeatmapsetPost()) {
            $this->validationErrors()->add('base', '.beatmapset_post_no_delete');

            return false;
        }

        return parent::delete();
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if (!$this->skipBodyPresenceCheck && !present($this->post_text)) {
            $this->validationErrors()->add('post_text', 'required');
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
            return
                $this->getKey() === $this->topic->topic_first_post_id &&
                $this->topic->beatmapset()->exists();
        }
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.post';
    }

    public function getBodyHTMLAttribute()
    {
        return bbcode($this->post_text, $this->bbcode_uid, ['withGallery' => true]);
    }

    public function getBodyHTMLWithoutImageDimensionsAttribute()
    {
        return bbcode($this->post_text, $this->bbcode_uid, ['withGallery' => true, 'withoutImageDimensions' => true]);
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
        dispatch(new EsIndexDocument($this));
    }

    public function markRead($user)
    {
        if ($user === null) {
            return;
        }

        $topic = $this->topic()->withTrashed()->first();

        if ($topic === null) {
            return;
        }

        $topic->markRead($user, $this->post_time);

        // reset notification status when viewing latest post
        if ($topic->topic_last_post_id === $this->getKey()) {
            TopicWatch::lookupQuery($topic, $user)->update(['notify_status' => false]);
        }
    }
}
