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

use Illuminate\Database\Eloquent\Model;

class BeatmapDiscussion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'beatmapset_discussion_id' => 'integer',
        'beatmap_id' => 'integer',
        'user_id' => 'integer',

        'timestamp' => 'integer',
        'resolved' => 'boolean',
    ];

    const MESSAGE_TYPES = [
        'praise' => 0,
        'suggestion' => 1,
        'problem' => 2,
    ];

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class);
    }

    public function beatmapDiscussionReplies()
    {
        return $this->hasMany(BeatmapDiscussionReply::class);
    }

    public function beatmapsetDiscussion()
    {
        return $this->belongsTo(BeatmapsetDiscussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMessageTypeAttribute($value)
    {
        return array_search_null(get_int($value), static::MESSAGE_TYPES);
    }

    public function setMessageTypeAttribute($value)
    {
        return $this->attributes['message_type'] = array_get(static::MESSAGE_TYPES, $value);
    }

    public function hasValidBeatmap()
    {
        return
            $this->beatmap_id === null ||
            ($this->beatmap && $this->beatmap->beatmapset_id === $this->beatmapsetDiscussion->beatmapset_id);
    }

    /*
     * Called before saving. The callback definition is located in
     * App\Providers\AppServiceProvider. Don't ask me why it's there;
     * ask Laravel.
     */
    public function isValid()
    {
        return $this->hasValidBeatmap();
    }
}
