<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\Model;
use App\Models\User;
use App\Traits\WithDbCursorHelper;
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
 * @property \Illuminate\Database\Eloquent\Collection $scores Score
 * @property \Carbon\Carbon $starts_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 */
class Room extends Model
{
    use SoftDeletes, WithDbCursorHelper;

    const SORTS = [
        'ended' => [
            ['column' => 'ends_at', 'order' => 'DESC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'DESC', 'type' => 'int'],
        ],
        'created' => [
            ['column' => 'id', 'order' => 'DESC', 'type' => 'int'],
        ],
    ];

    const DEFAULT_SORT = 'ended';

    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];
    protected $attributes = [
        'participant_count' => 0,
    ];

    public static function search($params, $preloads = null, $includes = null)
    {
        $query = static::query();

        $mode = presence(get_string($params['mode'] ?? null));
        $user = $params['user'];
        $sort = 'created';

        $category = presence(get_string($params['category'] ?? null)) ?? 'any';
        if ($category === 'any') {
            $query->where('category', '<>', 'realtime');
        } else {
            $query->where('category', $category);
        }

        switch ($mode) {
            case 'ended':
                $query->ended();
                $sort = 'ended';
                break;
            case 'participated':
                $query->hasParticipated($user);
                break;
            case 'owned':
                $query->startedBy($user);
                break;
            default:
                $query->active();
        }

        $query->cursorSort($sort, $params['cursor'] ?? null);

        foreach ($preloads ?? [] as $preload) {
            $query->with($preload);
        }

        $limit = clamp(get_int($params['limit'] ?? 250), 1, 250);
        $query->limit($limit);

        return json_collection($query->get(), 'Multiplayer\Room', $includes ?? []);
    }

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
        return $this->hasMany(Score::class);
    }

    public function userHighScores()
    {
        return $this->hasMany(UserScoreAggregate::class);
    }

    public function scopeActive($query)
    {
        return $query
            ->where('starts_at', '<', Carbon::now())
            ->where(function ($q) {
                $q->where('ends_at', '>', Carbon::now())->orWhereNull('ends_at');
            });
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
            Score::withoutTrashed()->where('user_id', $user->getKey())->select('room_id')
        );
    }

    public function scopeStartedBy($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function hasEnded()
    {
        return $this->ends_at !== null && Carbon::now()->gte($this->ends_at);
    }

    public function isScoreSubmissionStillAllowed()
    {
        // TODO: move grace period to config or use the beatmap's duration
        return $this->ends_at === null || Carbon::now()->lte($this->ends_at->addMinutes(5));
    }

    /**
     * Convenience method to generate missing top scores of the room.
     *
     * @return void
     */
    public function calculateMissingTopScores()
    {
        // just run through all the users, UserScoreAggregate::new will calculate and persist if necessary.
        $users = User::whereIn('user_id', Score::where('room_id', $this->getKey())->select('user_id'));
        $users->each(function ($user) {
            UserScoreAggregate::new($user, $this);
        });
    }

    public function completePlay(Score $score, array $params)
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

        $this->name = get_string($params['name'] ?? null);
        $this->user_id = $owner->getKey();
        $this->max_attempts = get_int($params['max_attempts'] ?? null);
        $this->starts_at = now();

        $category = $params['category'] ?? null;
        if ($category === 'realtime') {
            $this->category = $category;
            $this->ends_at = now()->addSeconds(30);
        } else {
            $endsAt = parse_time_to_carbon($params['ends_at'] ?? null);
            if ($endsAt !== null) {
                $this->ends_at = $endsAt;
            } else {
                $duration = get_int($params['duration'] ?? null);
                if ($duration !== null) {
                    $this->ends_at = $this->starts_at->copy()->addMinutes($duration);
                }
            }
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

        $playlistItemsCount = count($playlistItems);

        if ($this->category === 'realtime' && $playlistItemsCount !== 1) {
            throw new InvariantException('realtime room must have exactly one playlist item');
        }

        if ($playlistItemsCount < 1) {
            throw new InvariantException('room must have at least one playlist item');
        }

        PlaylistItem::assertBeatmapsExist($playlistItems);

        $this->getConnection()->transaction(function () use ($owner, $playlistItems) {
            $this->save(); // need to persist to get primary key for channel name.

            $channel = Channel::createMultiplayer($this);
            $channel->addUser($owner);

            $this->update(['channel_id' => $channel->channel_id]);

            foreach ($playlistItems as $playlistItem) {
                $playlistItem->room()->associate($this);
                $playlistItem->save();
            }
        });

        // to load db-level default attributes
        return $this->fresh();
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

            return Score::start([
                'user_id' => $user->getKey(),
                'room_id' => $this->getKey(),
                'playlist_item_id' => $playlistItem->getKey(),
                'beatmap_id' => $playlistItem->beatmap_id,
            ]);
        });
    }

    public function topScores()
    {
        return $this->userHighScores()->forRanking()->with('user.country');
    }

    private function assertValidCompletePlay()
    {
        if (!$this->isScoreSubmissionStillAllowed()) {
            throw new InvariantException('Room is no longer accepting scores.');
        }
    }

    private function assertValidStartGame()
    {
        foreach (['ends_at', 'name'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("'{$field}' is required");
            }
        }

        if ($this->category !== 'realtime' && $this->starts_at->addMinutes(30)->gt($this->ends_at)) {
            throw new InvariantException("'ends_at' must be at least 30 minutes after 'starts_at'");
        }

        if ($this->max_attempts !== null) {
            $maxAttemptsLimit = config('osu.multiplayer.max_attempts_limit');
            if ($this->max_attempts < 1 || $this->max_attempts > $maxAttemptsLimit) {
                throw new InvariantException("field 'max_attempts' must be between 1 and {$maxAttemptsLimit}");
            }
        }
    }

    private function assertValidStartPlay(User $user, PlaylistItem $playlistItem)
    {
        // todo: check against room's end time (to see if player has enough time to play this beatmap) and is under the room's max attempts limit

        if ($this->hasEnded()) {
            throw new InvariantException('Room has already ended.');
        }

        if ($this->max_attempts !== null) {
            $roomStats = $this->userHighScores()->where('user_id', $user->getKey())->first();
            if ($roomStats !== null && $roomStats->attempts >= $this->max_attempts) {
                throw new InvariantException('You have reached the maximum number of tries allowed.');
            }
        }

        if ($playlistItem->max_attempts !== null) {
            $playlistAttempts = $playlistItem->scores()->where('user_id', $user->getKey())->count();
            if ($playlistAttempts >= $playlistItem->max_attempts) {
                throw new InvariantException('You have reached the maximum number of tries allowed.');
            }
        }

        if ($playlistItem->expired) {
            throw new InvariantException('Cannot play an expired playlist item.');
        }
    }
}
