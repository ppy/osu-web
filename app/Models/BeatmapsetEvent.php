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

class BeatmapsetEvent extends Model
{
    protected $guarded = [];

    const NOMINATE = 'nominate';
    const QUALIFY = 'qualify';
    const DISQUALIFY = 'disqualify';
    const APPROVE = 'approve';
    const RANK = 'rank';

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeNominations($query)
    {
        return $query->where('type', BeatmapsetEvent::NOMINATE);
    }

    public function scopeDisqualifications($query)
    {
        return $query->where('type', BeatmapsetEvent::DISQUALIFY);
    }
}
