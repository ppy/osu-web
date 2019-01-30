<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

/**
 * @property mixed $detail
 * @property int $event_id
 * @property Game $game
 * @property int|null $game_id
 * @property Match $match
 * @property int $match_id
 * @property string|null $text
 * @property \Carbon\Carbon|null $timestamp
 * @property User $user
 * @property int|null $user_id
 */
class Event extends Model
{
    protected $primaryKey = 'event_id';
    protected $dates = [
        'timestamp',
    ];
    public $timestamps = false;

    const EVENT_TYPES = [
        'player-left' => 'PART',
        'player-joined' => 'JOIN',
        'player-kicked' => 'KICK',
        'match-created' => 'CREATE',
        'match-disbanded' => 'DISBAND',
        'host-changed' => 'HOST',
    ];

    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeDefault($query)
    {
        return $query->orderBy('event_id', 'asc');
    }

    public function getDetailAttribute()
    {
        $value = $this->text;

        if (in_array($value, self::EVENT_TYPES, true)) {
            return ['type' => array_search_null($value, self::EVENT_TYPES)];
        } else {
            return ['type' => 'other', 'text' => $value];
        }
    }
}
