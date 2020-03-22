<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Comment $comment
 * @property int $comment_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class CommentVote extends Model
{
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delete()
    {
        return $this->getConnection()->transaction(function () {
            $decrementParentCounter = $this->exists;
            $result = parent::delete();

            if ($result && $decrementParentCounter) {
                $this->comment()->getQuery()->withoutTrashed()->update([
                    'votes_count_cache' => db_unsigned_increment('votes_count_cache', -1),
                ]);
            }

            return $result;
        });
    }

    public function save(array $options = [])
    {
        if (optional($this->comment)->trashed()) {
            return false;
        }

        return $this->getConnection()->transaction(function () use ($options) {
            $incrementParentCounter = !$this->exists;
            $result = parent::save($options);

            if ($result && $incrementParentCounter) {
                $this->comment()->getQuery()->withoutTrashed()->increment('votes_count_cache');
            }

            return $result;
        });
    }
}
