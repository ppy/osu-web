<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Multiplayer;

use App\Models\User;
use Cache;

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

    public function hadPlayer(User $user)
    {
        return Cache::remember("multiplayer_participation_{$this->match_id}_{$user->user_id}", 60, function () use ($user) {
            return $this->events()->where('user_id', $user->user_id)->whereIn('text', ['CREATE', 'JOIN'])->exists();
        });
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
