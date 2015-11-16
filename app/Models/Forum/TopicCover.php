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

use App\Libraries\ImageProcessor;
use App\Libraries\StorageAuto;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Model;

class TopicCover extends Model
{
    protected $table = 'forum_topic_covers';

    protected $casts = [
        'id' => 'integer',
        'topic_id' => 'integer',
        'user_id' => 'integer',
    ];

    private $storage = null;

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

    public function __construct($attributes = [])
    {
        $this->storage = StorageAuto::get();

        return parent::__construct($attributes);
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
        if (isset($this->_owner) === false) {
            if ($this->topic !== null) {
                $this->_owner = User::find($this->topic->topic_poster);
            }

            if ($this->_owner === null) {
                $this->_owner = $this->user;
            }
        }

        return $this->_owner;
    }

    public function fileDir()
    {
        return "topic-covers/{$this->id}";
    }

    public function fileName()
    {
        return "{$this->hash}.{$this->ext}";
    }

    public function filePath()
    {
        return $this->fileDir().'/'.$this->fileName();
    }

    public function fileUrl()
    {
        return $this->storage->url($this->filePath());
    }

    public function deleteWithFile()
    {
        $this->deleteFile();

        return $this->delete();
    }

    public function deleteFile()
    {
        if (presence($this->hash) === null) {
            return;
        }

        return $this->storage->deleteDirectory($this->fileDir());
    }

    public function storeFile($filePath)
    {
        $image = new ImageProcessor($filePath, [2700, 700], 1000000);
        $image->process();

        $this->deleteFile();
        $this->hash = hash_file('sha256', $image->inputPath);
        $this->ext = $image->ext();

        $this->storage->put($this->filePath(), file_get_contents($image->inputPath));
    }

    public function updateFile($filePath, $user)
    {
        $cover->user()->associate($user);
        $cover->storeFile($filePath);
        $cover->save();

        return $this->fresh();
    }

    public function canBeUpdatedBy($user)
    {
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
}
