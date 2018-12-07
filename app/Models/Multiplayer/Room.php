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

namespace App\Models\Multiplayer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Validator;

class Room extends \App\Models\Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function playlist()
    {
        return $this->hasMany(PlaylistItem::class, 'room_id');
    }

    public function scopeActive($query)
    {
        return $query
            ->where('starts_at', '<', Carbon::now())
            ->where('ends_at', '>', Carbon::now());
    }

    public function scopeStartedBy($query, \App\Models\User $user)
    {
        return $query->where('user_id', $user->user_id);
    }
}
