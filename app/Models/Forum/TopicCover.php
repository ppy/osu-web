<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Models\User;
use App\Traits\Imageable;
use DB;
use Exception;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $ext
 * @property string|null $hash
 * @property int $id
 * @property Topic $topic
 * @property int|null $topic_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 */
class TopicCover extends Model
{
    use Imageable;

    const MAX_DIMENSIONS = [2400, 580];

    protected $table = 'forum_topic_covers';

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
        $cover = new static();

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
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function defaultFileUrl()
    {
        try {
            return $this->topic->forum->cover->defaultTopicCover->fileUrl();
        } catch (Exception $_e) {
            // do nothing
        }
    }
}
