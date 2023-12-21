<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Casts\LegacyFilename;
use App\Libraries\Uploader;
use App\Models\User;
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
    const MAX_DIMENSIONS = [2000, 400];

    protected $casts = [
        'default_topic_cover_json' => 'array',
        'filename' => LegacyFilename::class,
    ];
    protected $table = 'forum_forum_covers';

    private Uploader $defaultTopicCoverUploader;
    private Uploader $file;

    public static function upload($filePath, $user, $forum = null)
    {
        $cover = new static();

        DB::transaction(function () use ($cover, $filePath, $user, $forum) {
            $cover->save(); // get id
            $cover->user()->associate($user);
            $cover->forum()->associate($forum);
            $cover->file()->store($filePath);
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

    public function getDefaultTopicCoverAttribute(): Uploader
    {
        return $this->defaultTopicCoverUploader ??= new Uploader(
            'forum-default-topic-covers',
            $this,
            'default_topic_cover_filename',
            ['image' => ['maxDimensions' => TopicCover::MAX_DIMENSIONS]],
        );
    }

    public function setDefaultTopicCoverAttribute($value): void
    {
        if (($value['_delete'] ?? false) === true) {
            $this->defaultTopicCover->delete();
        } elseif (($value['cover_file'] ?? null) !== null) {
            $this->defaultTopicCover->store($value['cover_file']);
        }
    }

    public function getDefaultTopicCoverFilenameAttribute(): ?string
    {
        return LegacyFilename::makeFromAttributes($this->default_topic_cover_json);
    }

    public function setDefaultTopicCoverFilenameAttribute(?string $value): void
    {
        $this->default_topic_cover_json = [
            'ext' => null,
            'hash' => $value,
        ];
    }

    public function setMainCoverAttribute($value): void
    {
        if ($value['_delete'] ?? false) {
            $this->file()->delete();
        } elseif (isset($value['cover_file'])) {
            $this->file()->store($value['cover_file']);
        }
    }

    public function delete()
    {
        $this->file()->delete();
        $this->defaultTopicCover->delete();

        return parent::delete();
    }

    public function file(): Uploader
    {
        return $this->file ??= new Uploader(
            'forum-covers',
            $this,
            'filename',
            ['image' => ['maxDimensions' => static::MAX_DIMENSIONS]],
        );
    }

    public function updateFile($filePath, $user)
    {
        $this->user()->associate($user);
        $this->file()->store($filePath);
        $this->save();

        return $this->fresh();
    }
}
