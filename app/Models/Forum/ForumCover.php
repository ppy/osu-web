<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Libraries\ForumDefaultTopicCover;
use App\Models\User;
use App\Traits\Imageable;
use DB;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property mixed $default_topic_cover
 * @property array|null $default_topic_cover_json
 * @property string|null $ext
 * @property Forum $forum
 * @property int|null $forum_id
 * @property string|null $hash
 * @property int $id
 * @property mixed $main_cover
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 */
class ForumCover extends Model
{
    use Imageable;

    protected $table = 'forum_forum_covers';

    protected $casts = [
        'default_topic_cover_json' => 'array',
    ];

    private $_defaultTopicCover;

    public function getMaxDimensions()
    {
        return [2000, 400];
    }

    public function getFileRoot()
    {
        return 'forum-covers';
    }

    public static function upload($filePath, $user, $forum = null)
    {
        $cover = new static();

        DB::transaction(function () use ($cover, $filePath, $user, $forum) {
            $cover->save(); // get id
            $cover->user()->associate($user);
            $cover->forum()->associate($forum);
            $cover->storeFile($filePath);
            $cover->save();
        });

        return $cover;
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updateFile($filePath, $user)
    {
        $this->user()->associate($user);
        $this->storeFile($filePath);
        $this->save();

        return $this->fresh();
    }

    public function getDefaultTopicCoverAttribute()
    {
        if ($this->_defaultTopicCover === null) {
            $this->_defaultTopicCover = new ForumDefaultTopicCover($this->id, $this->default_topic_cover_json);
        }

        return $this->_defaultTopicCover;
    }

    public function setMainCoverAttribute($value)
    {
        if (($value['_delete'] ?? false) === true) {
            $this->deleteFile();
        } elseif (($value['cover_file'] ?? null) !== null) {
            $this->storeFile($value['cover_file']);
        }
    }

    public function setDefaultTopicCoverAttribute($value)
    {
        if (($value['_delete'] ?? false) === true) {
            $this->defaultTopicCover->deleteFile();
        } elseif (($value['cover_file'] ?? null) !== null) {
            $this->defaultTopicCover->storeFile($value['cover_file']);
        }

        $this->default_topic_cover_json = $this->defaultTopicCover->getFileProperties();
    }
}
