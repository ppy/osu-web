<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\LegacyMatch;

use App\Models\Traits\WithDbCursorHelper;
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
class LegacyMatch extends Model
{
    use WithDbCursorHelper;

    const SORTS = [
        'id_asc' => [
            ['column' => 'match_id', 'order' => 'ASC'],
        ],
        'id_desc' => [
            ['column' => 'match_id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'id_desc';

    public $timestamps = false;

    protected $primaryKey = 'match_id';
    protected $hidden = ['private', 'keep_forever'];
    protected $casts = [
        'keep_forever' => 'boolean',
    ];
    protected $dates = [
        'start_time',
        'end_time',
    ];
    protected $table = 'matches';

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
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

    public function isTournamentMatch()
    {
        // keep_forever is being re-purposed to mark matches as 'tournament matches' (which will allow for public-read of chat and what-not)
        return $this->keep_forever;
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
