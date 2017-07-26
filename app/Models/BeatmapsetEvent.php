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

class BeatmapsetEvent extends Model
{
    protected $guarded = [];

    const NOMINATE = 'nominate';
    const QUALIFY = 'qualify';
    const DISQUALIFY = 'disqualify';
    const APPROVE = 'approve';
    const RANK = 'rank';

    const KUDOSU_ALLOW = 'kudosu_allow';
    const KUDOSU_DENY = 'kudosu_deny';
    const KUDOSU_GAIN = 'kudosu_gain';
    const KUDOSU_LOST = 'kudosu_lost';

    const ISSUE_RESOLVE = 'issue_resolve';
    const ISSUE_REOPEN = 'issue_reopen';

    const DISCUSSION_DELETE = 'discussion_delete';
    const DISCUSSION_RESTORE = 'discussion_restore';

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeNominations($query)
    {
        return $query->where('type', self::NOMINATE);
    }

    public function scopeDisqualifications($query)
    {
        return $query->where('type', self::DISQUALIFY);
    }

    public function hasArrayComment()
    {
        return in_array($this->type, [
            static::KUDOSU_ALLOW,
            static::KUDOSU_DENY,
            static::KUDOSU_GAIN,
            static::KUDOSU_LOST,
            static::ISSUE_RESOLVE,
            static::ISSUE_REOPEN,
            static::DISCUSSION_DELETE,
            static::DISCUSSION_RESTORE,
        ], true);
    }

    public function getCommentAttribute($value)
    {
        return $this->hasArrayComment() ? json_decode($value, true) : $value;
    }

    public function setCommentAttribute($value)
    {
        if ($this->hasArrayComment()) {
            $value = json_encode($value);
        }

        $this->attributes['comment'] = $value;
    }
}
