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

    protected $touches = ['beatmapsetDiscussion'];

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

    public function beatmapset()
    {
        return $this->beatmap->beatmapset();
    }

    public function beatmapDiscussionPosts()
    {
        return $this->hasMany(BeatmapDiscussionPost::class);
    }

    public function beatmapDiscussionVotes()
    {
        return $this->hasMany(BeatmapDiscussionVote::class);
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
        return $this->attributes['message_type'] = static::MESSAGE_TYPES[$value] ?? null;
    }

    public function hasValidBeatmap()
    {
        return
            $this->beatmap_id === null ||
            ($this->beatmap && $this->beatmap->beatmapset_id === $this->beatmapsetDiscussion->beatmapset_id);
    }

    public function hasValidMessageType()
    {
        return
            ($this->beatmap_id === null && $this->message_type === null) ||
            ($this->beatmap_id !== null && $this->message_type !== null);
    }

    public function hasValidTimestamp()
    {
        return
            ($this->timestamp === null) ||
            ($this->beatmap_id !== null && $this->timestamp >= 0 && $this->timestamp < ($this->beatmap->total_length * 1000));
    }

    public function canBeVotedBy($user)
    {
        return $user !== null;
    }

    public function canBeResolvedBy($user)
    {
        // no point resolving general discussion?
        if ($this->timestamp === null) {
            return false;
        }

        if ($user === null) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($user->user_id === $this->user_id) {
            return true;
        }

        if ($user->user_id === $this->beatmapset->user_id) {
            return true;
        }

        return false;
    }

    public function canBePostedBy($user)
    {
        return $user !== null;
    }

    public function getVotesSummaryAttribute()
    {
        $votes = ['up' => 0, 'down' => 0];

        foreach ($this->beatmapDiscussionVotes as $vote) {
            if ($vote->score === 1) {
                $votes['up'] += 1;
            } elseif ($vote->score === -1) {
                $votes['down'] += 1;
            }
        }

        return $votes;
    }

    /*
     * Called before saving. The callback definition is located in
     * App\Providers\AppServiceProvider. Don't ask me why it's there;
     * ask Laravel.
     */
    public function isValid()
    {
        return $this->hasValidBeatmap() &&
            $this->hasValidMessageType() &&
            $this->hasValidTimestamp();
    }
}
