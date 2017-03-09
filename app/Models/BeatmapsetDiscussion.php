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

use App\Transformers\BeatmapsetDiscussionTransformer;

class BeatmapsetDiscussion extends Model
{
    protected $guarded = [];

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function user()
    {
        return $this->beatmapset->user();
    }

    public function defaultJson()
    {
        $includes = [
            'beatmap_discussions.beatmap_discussion_posts',
            'beatmap_discussions.current_user_attributes',
            'users',
        ];

        return json_item(
            static::with([
                'beatmapDiscussions.beatmapDiscussionPosts',
                'beatmapDiscussions.beatmapDiscussionVotes',
            ])->find($this->id),
            new BeatmapsetDiscussionTransformer(),
            $includes
        );
    }
}
