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

/**
 * @property \Carbon\Carbon|null $end_time
 * @property \Illuminate\Database\Eloquent\Collection $events Event
 * @property \Illuminate\Database\Eloquent\Collection $games Game
 * @property mixed $keep_forever
 * @property int $match_id
 * @property string $name
 * @property mixed $private
 * @property \Carbon\Carbon|null $start_time
 */
class Match extends Model
{
    protected $primaryKey = 'match_id';
    protected $hidden = ['private', 'keep_forever'];
    protected $dates = [
        'start_time',
        'end_time',
    ];
    public $timestamps = false;

    public function games()
    {
        return $this->hasMany(Game::class, 'match_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'match_id');
    }

    public function currentGame()
    {
        $game = $this->games()->last();

        if ($game !== null && $game->end_time === null) {
            return $game;
        }
    }

    public function currentPlayers()
    {
        $players = [];
        if (!$this->end_time) { // match hasn't ended, i.e. ongoing match
            $join_events = $this->events()->whereIn('text', ['JOIN', 'PART'])->orderBy('event_id', 'asc')->get();
            foreach ($join_events as $event) {
                if ($event->text === 'JOIN') {
                    array_push($players, $event->user_id);
                } else {
                    array_splice($players, array_search($event->user_id, $players, true), 1);
                }
            }
        }

        return $players;
    }
}
