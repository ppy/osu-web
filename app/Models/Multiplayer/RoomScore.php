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

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomScore extends \App\Models\Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_scores';
    protected $dates = ['started_at', 'ended_at'];
    protected $casts = [
        'passed' => 'boolean',
        'mods' => 'array',
        'statistics' => 'array',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('ended_at');
    }

    public function scopeForPlaylistItem($query, $playlistItemId)
    {
        return $query->where('playlist_item_id', $playlistItemId);
    }

    public function isCompleted()
    {
        return present($this->ended_at);
    }
}
