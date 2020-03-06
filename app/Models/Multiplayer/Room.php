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

use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Channel $channel
 * @property int|null $channel_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon $ends_at
 * @property User $host
 * @property int $id
 * @property int|null $max_attempts
 * @property string $name
 * @property int $participant_count
 * @property \Illuminate\Database\Eloquent\Collection $playlist PlaylistItem
 * @property \Illuminate\Database\Eloquent\Collection $scores RoomScore
 * @property \Carbon\Carbon $starts_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 */
class Room extends Model
{
    use SoftDeletes;

    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];
    protected $attributes = [
        'participant_count' => 0,
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function playlist()
    {
        return $this->hasMany(PlaylistItem::class);
    }

    public function scores()
    {
        return $this->hasMany(RoomScore::class);
    }

    public function userHighScores()
    {
        return $this->hasMany(RoomUserHighScore::class);
    }

    public function scopeActive($query)
    {
        return $query
            ->where('starts_at', '<', Carbon::now())
            ->where('ends_at', '>', Carbon::now());
    }

    public function scopeEnded($query)
    {
        return $query->where('ends_at', '<', Carbon::now());
    }

    public function scopeHasParticipated($query, User $user)
    {
        return $query->whereIn(
            'id',
            // SoftDelete scope is ignored, fixed in 5.8:
            // https://github.com/laravel/framework/pull/26198
            RoomScore::withoutTrashed()->where('user_id', $user->getKey())->select('room_id')
        );
    }

    public function scopeStartedBy($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function hasEnded()
    {
        return Carbon::now()->gte($this->ends_at);
    }

    public function isScoreSubmissionStillAllowed()
    {
        // TODO: move grace period to config.
        return Carbon::now()->lte($this->ends_at->addMinutes(5));
    }

    /**
     * Convenience method to generate missing top scores of the room.
     *
     * @return void
     */
    public function calculateMissingTopScores()
    {
        // just run through all the users, UserScoreAggregate::new will calculate and persist if necessary.
        $users = User::whereIn('user_id', RoomScore::where('room_id', $this->getKey())->select('user_id'));
        $users->each(function ($user) {
            UserScoreAggregate::new($user, $this);
        });
    }

    public function completePlay(RoomScore $score, array $params)
    {
        priv_check_user($score->user, 'MultiplayerScoreSubmit')->ensureCan();

        $this->assertValidCompletePlay();

        return $score->getConnection()->transaction(function () use ($params, $score) {
            $score->complete($params);
            UserScoreAggregate::new($score->user, $this)->addScore($score);

            return $score;
        });
    }

    public function join(User $user)
    {
        if (!$this->channel->hasUser($user)) {
            $this->channel->addUser($user);
        }
    }

    public function startGame(User $owner, array $params)
    {
        priv_check_user($owner, 'MultiplayerRoomCreate')->ensureCan();

        $userRoomCount = static::active()->startedBy($owner)->count();

        if ($userRoomCount >= $owner->maxMultiplayerRooms()) {
            throw new InvariantException('number of simultaneously active rooms reached');
        }

        $this->name = $params['name'] ?? null;
        $this->user_id = $owner->getKey();
        $this->max_attempts = get_int($params['max_attempts'] ?? null);
        $this->starts_at = Carbon::parse($params['starts_at'] ?? null);

        if ($params['ends_at'] ?? null !== null) {
            $this->ends_at = Carbon::parse($params['ends_at']);
        } elseif ($params['duration'] ?? null !== null) {
            $this->ends_at = $this->starts_at->copy()->addMinutes(get_int($params['duration']));
        }

        $this->assertValidStartGame();

        $playlistParams = $params['playlist'] ?? [];
        if (!is_array($playlistParams)) {
            throw new InvariantException("field 'playlist' must an an array");
        }

        $playlistItems = [];
        foreach ($playlistParams as $item) {
            $playlistItems[] = PlaylistItem::fromJsonParams($item);
        }

        if (count($playlistItems) < 1) {
            throw new InvariantException('room must have at least one playlist item');
        }

        PlaylistItem::assertBeatmapsExist($playlistItems);

        $this->getConnection()->transaction(function () use ($owner, $playlistItems) {
            $this->save(); // need to persist to get primary key for channel name.

            // create the chat channel for the room
            $channel = new Channel();
            $channel->name = "#lazermp_{$this->getKey()}";
            $channel->type = Channel::TYPES['multiplayer'];
            $channel->description = $this->name;
            $channel->save();

            $channel->addUser($owner);

            $this->update(['channel_id' => $channel->channel_id]);

            foreach ($playlistItems as $playlistItem) {
                $playlistItem->room()->associate($this);
                $playlistItem->save();
            }
        });

        return $this;
    }

    public function startPlay(User $user, PlaylistItem $playlistItem)
    {
        priv_check_user($user, 'MultiplayerScoreSubmit')->ensureCan();

        $this->assertValidStartPlay($user, $playlistItem);

        return $this->getConnection()->transaction(function () use ($user, $playlistItem) {
            $agg = UserScoreAggregate::new($user, $this);
            if ($agg->isNew) {
                // sanity; if the object isn't saved, laravel will increment the entire table.
                if (!$this->exists) {
                    $this->save();
                }

                $this->increment('participant_count');
            }

            $agg->updateUserAttempts();

            return RoomScore::start([
                'user_id' => $user->getKey(),
                'room_id' => $this->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'beatmap_id' => $playlistItem->beatmap_id,
            ]);
        });
    }

    public function topScores()
    {
        $userIdsQuery = User::default()
            ->whereIn('user_id', RoomScore::where('room_id', $this->getKey())->select('user_id'))
            ->select('user_id');

        return UserScoreAggregate::where('room_id', $this->getKey())
            ->where('completed', '>', 0)
            ->whereIn('user_id', $userIdsQuery)
            ->orderBy('total_score', 'desc')
            ->orderBy('updated_at', 'asc')
            ->orderBy('id', 'asc')
            ->with('user.country');
    }

    private function assertValidCompletePlay()
    {
        if (!$this->isScoreSubmissionStillAllowed()) {
            throw new InvariantException('Room is no longer accepting scores.');
        }
    }

    private function assertValidStartGame()
    {
        foreach (['name', 'starts_at', 'ends_at'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("'{$field}' is required");
            }
        }

        if ($this->starts_at->addMinutes(30)->gt($this->ends_at)) {
            throw new InvariantException("'ends_at' must be at least 30 minutes after 'starts_at'");
        }

        if ($this->max_attempts !== null) {
            if ($this->max_attempts < 1 || $this->max_attempts > 32) {
                throw new InvariantException("field 'max_attempts' must be between 1 and 32");
            }
        }
    }

    private function assertValidStartPlay(User $user, PlaylistItem $playlistItem)
    {
        // todo: check against room's end time (to see if player has enough time to play this beatmap) and is under the room's max attempts limit

        if ($this->hasEnded()) {
            throw new InvariantException('Room has already ended.');
        }

        if ($this->max_attempts !== null
            && $playlistItem->scores()->where('user_id', $user->getKey())->count() >= $this->max_attempts
        ) {
            throw new InvariantException('You have reached the maximum number of tries allowed.');
        }
    }
}
