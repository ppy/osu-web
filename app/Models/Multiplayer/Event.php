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
namespace App\Models\Multiplayer;

use App\Models\User;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $dates = [
        'timestamp',
    ];
    public $timestamps = false;

    const EVENT_TYPES = [
        'PART' => 'player-left',
        'JOIN' => 'player-joined',
        'KICK' => 'player-kicked',
        'CREATE' => 'match-created',
        'DISBAND' => 'match-disbanded',
        'HOST' => 'host-changed',
    ];

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDefault($query)
    {
        return $query->orderBy('event_id', 'asc');
    }

    public function getTextAttribute($value)
    {
        if (array_key_exists($value, self::EVENT_TYPES)) {
            return self::EVENT_TYPES[$value];
        }

        return $value;
    }
}
