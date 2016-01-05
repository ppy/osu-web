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
use Illuminate\Database\Eloquent\Model;

class ForumCover extends Model
{
    use Imageable;

    protected $table = 'forum_forum_covers';

    protected $casts = [
        'id' => 'integer',
        'forum_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getMaxDimensions()
    {
        return [2700, 500];
    }

    public function getFileRoot()
    {
        return 'forum-covers';
    }

    public static function upload($filePath, $user, $forum = null)
    {
        $cover = new static;

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
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateFile($filePath, $user)
    {
        $this->user()->associate($user);
        $this->storeFile($filePath);
        $this->save();

        return $this->fresh();
    }
}
