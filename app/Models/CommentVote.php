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
