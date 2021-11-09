<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\MorphMap;
use App\Traits\Validatable;
use App\Traits\WithDbCursorHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property mixed $commentable
 * @property int|null $commentable_id
 * @property mixed|null $commentable_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $deleted_by_id
 * @property int|null $disqus_id
 * @property int|null $disqus_parent_id
 * @property string|null $disqus_thread_id
 * @property array|null $disqus_user_data
 * @property \Carbon\Carbon|null $edited_at
 * @property int|null $edited_by_id
 * @property User $editor
 * @property int $id
 * @property string $message
 * @property static $parent
 * @property int|null $parent_id
 * @property bool $pinned
 * @property \Illuminate\Database\Eloquent\Collection $replies static
 * @property int $replies_count_cache
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 * @property \Illuminate\Database\Eloquent\Collection $votes CommentVote
 * @property int $votes_count_cache
 */
class Comment extends Model
{
    use Reportable, Validatable, WithDbCursorHelper;

    const COMMENTABLES = [
        MorphMap::MAP[Beatmapset::class],
        MorphMap::MAP[Build::class],
        MorphMap::MAP[NewsPost::class],
    ];

    // FIXME: decide on good number.
    // some people seem to put song lyrics in comment which inflated the size.
    const MESSAGE_LIMIT = 10000;

    const SORTS = [
        'new' => [
            ['column' => 'created_at', 'order' => 'DESC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'DESC'],
        ],
        'old' => [
            ['column' => 'created_at', 'order' => 'ASC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'ASC'],
        ],
        'top' => [
            ['column' => 'votes_count_cache', 'columnInput' => 'votes_count', 'order' => 'DESC'],
            ['column' => 'created_at', 'order' => 'DESC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'new';

    protected $dates = ['deleted_at', 'edited_at'];

    protected $casts = [
        'disqus_user_data' => 'array',
        'pinned' => 'boolean',
    ];

    public $allowEmptyCommentable = false;

    public static function isValidType($type)
    {
        return in_array($type, static::COMMENTABLES, true);
    }

    public function scopePinned(Builder $query): Builder
    {
        return $query->where('pinned', true);
    }

    public function scopeWithoutTrashed($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function setMessageAttribute($value)
    {
        return $this->attributes['message'] = unzalgo($value);
    }

    public function votes()
    {
        return $this->hasMany(CommentVote::class);
    }

    public function setCommentableTypeAttribute($value)
    {
        if (!static::isValidType($value)) {
            $value = null;
        }

        $this->attributes['commentable_type'] = $value;
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        $messageLength = mb_strlen(trim($this->message));

        if ($this->isDirty('pinned') && $this->pinned && $this->parent_id !== null) {
            $this->validationErrors()->add('pinned', '.top_only');
        }

        if ($messageLength === 0) {
            $this->validationErrors()->add('message', 'required');
        }

        if ($messageLength > static::MESSAGE_LIMIT) {
            $this->validationErrors()->add('message', 'too_long', ['limit' => static::MESSAGE_LIMIT]);
        }

        if ($this->isDirty('parent_id') && $this->parent_id !== null) {
            if ($this->parent === null) {
                $this->validationErrors()->add('parent_id', 'invalid');
            } elseif ($this->parent->trashed()) {
                $this->validationErrors()->add('parent_id', '.deleted_parent');
            }
        }

        if (
            !$this->allowEmptyCommentable && (
                $this->commentable_type === null ||
                $this->commentable_id === null ||
                !$this->commentable()->exists()
            ) && !$this->isDirty('deleted_at')
        ) {
            $this->validationErrors()->add('commentable', 'required');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function url()
    {
        return route('comments.show', ['comment' => $this->getKey()]);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'comment';
    }

    public function save(array $options = [])
    {
        if ($this->parent_id !== null && $this->parent !== null) {
            $this->commentable_id = $this->parent->commentable_id;
            $this->commentable_type = $this->parent->commentable_type;
        }

        if (!$this->isValid()) {
            return false;
        }

        return $this->getConnection()->transaction(function () use ($options) {
            if (!$this->exists && $this->parent_id !== null && $this->parent !== null) {
                // skips validation and everything
                $this->parent->increment('replies_count_cache');
            }

            if ($this->isDirty('deleted_at')) {
                if (isset($this->deleted_at)) {
                    $this->votes_count_cache = 0;
                } else {
                    $this->votes_count_cache = $this->votes()->count();
                }
            }

            return parent::save($options);
        });
    }

    public function legacyName()
    {
        return presence($this->disqus_user_data['name'] ?? null);
    }

    public function trashed()
    {
        return $this->deleted_at !== null;
    }

    public function softDelete($deletedBy)
    {
        return $this->update([
            'deleted_by_id' => $deletedBy->getKey(),
            'deleted_at' => Carbon::now(),
        ]);
    }

    public function restore()
    {
        return $this->update(['deleted_at' => null]);
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'reason' => 'Spam',
            'user_id' => $this->user_id,
        ];
    }
}
