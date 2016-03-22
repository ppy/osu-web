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
namespace App\Models;

use App\Transformers\BeatmapsetDiscussionTransformer;
use Illuminate\Database\Eloquent\Model;

class BeatmapsetDiscussion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'beatmapset_id' => 'integer',
    ];

    public function beatmapset()
    {
        return $this->belongsTo(BeatmapSet::class);
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function user()
    {
        return $this->beatmapset->user();
    }

    public function defaultJson($currentUser = null)
    {
        $includes = [
            'beatmap_discussions.user',
            'beatmap_discussions.beatmap_discussion_replies.user',
            'beatmap_discussion',
        ];

        if ($currentUser !== null) {
            $includes[] = "beatmap_discussions.current_user_attributes:user_id({$currentUser->user_id})";
        }

        return fractal_item_array(
            $this,
            new BeatmapsetDiscussionTransformer(),
            implode(',', $includes)
        );
    }

    public function canBePostedBy($user)
    {
        // FIXME: check for beatmapset status?
        return true;
    }
}
