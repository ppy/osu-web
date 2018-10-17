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

namespace App\Models;

use App\Traits\Validatable;
use Carbon\Carbon;

class Comment extends Model
{
    use Validatable;

    const COMMENTABLES = [
        'beatmapset' => Beatmapset::class,
        'build' => Build::class,
        'news_post' => NewsPost::class,
    ];

    // FIXME: decide on good number.
    // some people seem to put song lyrics in comment which inflated the size.
    const MESSAGE_LIMIT = 10000;

    protected $dates = ['deleted_at', 'edited_at'];

    protected $casts = [
        'disqus_user_data' => 'array',
    ];

    public $allowEmptyCommentable = false;

    public static function isValidType($type)
    {
        return array_key_exists($type, static::COMMENTABLES);
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

        if (!$this->allowEmptyCommentable && (
            $this->commentable_type === null ||
            $this->commentable_id === null ||
            !$this->commentable()->exists()
        )) {
            $this->validationErrors()->add('commentable', 'required');
        }

        return $this->validationErrors()->isEmpty();
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
}
