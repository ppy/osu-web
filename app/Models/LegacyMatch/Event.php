<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

use App\Models\User;

/**
 * @property mixed $detail
 * @property int $event_id
 * @property Game $game
 * @property int|null $game_id
 * @property LegacyMatch $legacyMatch
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

    public function legacyMatch()
    {
        return $this->belongsTo(LegacyMatch::class, 'match_id');
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
