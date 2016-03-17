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

use App\Models\User;
use App\Traits\Imageable;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class TopicCover extends Model
{
    use Imageable;

    const MAX_DIMENSIONS = [2700, 400];

    protected $table = 'forum_topic_covers';

    protected $casts = [
        'id' => 'integer',
        'topic_id' => 'integer',
        'user_id' => 'integer',
    ];

    private $_owner = [false, null];

    public function getMaxDimensions()
    {
        return static::MAX_DIMENSIONS;
    }

    public function getFileRoot()
    {
        return 'topic-covers';
    }

    public static function findForUse($id, $user)
    {
        if ($user === null) {
            return;
        }

        $covers = static::select();

        if ($user->isAdmin() === false) {
            $covers->where('user_id', $user->user_id);
        }

        return $covers->find($id);
    }

    public static function upload($filePath, $user, $topic = null)
    {
        $cover = new static;

        DB::transaction(function () use ($cover, $filePath, $user, $topic) {
            $cover->save(); // get id
            $cover->user()->associate($user);
            $cover->topic()->associate($topic);
            $cover->storeFile($filePath);
            $cover->save();
        });

        return $cover;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        if ($this->_owner[0] === false) {
            $this->_owner[0] = true;

            if ($this->topic !== null) {
                $this->_owner[1] = User::find($this->topic->topic_poster);
            }

            if ($this->_owner[1] === null) {
                $this->_owner[1] = $this->user;
            }
        }

        return $this->_owner[1];
    }

    public function updateFile($filePath, $user)
    {
        $this->user()->associate($user);
        $this->storeFile($filePath);
        $this->save();

        return $this->fresh();
    }

    public function canBeEditedBy($user)
    {
        if ($this->topic !== null) {
            return $this->topic->canBeEditedBy($user);
        }

        if ($user === null) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($this->owner() === null) {
            return false;
        }

        return $this->owner()->user_id === $user->user_id;
    }

    public function defaultFileUrl()
    {
        try {
            return $this->topic->forum->cover->defaultTopicCover->fileUrl();
        } catch (Exception $_e) {
            // do nothing
        }
    }
}
