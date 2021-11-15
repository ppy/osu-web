<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Casts\PresentString;
use App\Exceptions\InvariantException;
use App\Models\Chat\Channel;
use App\Models\Model;
use App\Models\User;
use App\Traits\Memoizes;
use App\Traits\WithDbCursorHelper;
use Carbon\Carbon;
use Ds\Set;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $category
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
    use Memoizes, SoftDeletes, WithDbCursorHelper;

    const SORTS = [
        'ended' => [
            ['column' => 'ends_at', 'order' => 'DESC', 'type' => 'time'],
            ['column' => 'id', 'order' => 'DESC', 'type' => 'int'],
        ],
        'created' => [
            ['column' => 'id', 'order' => 'DESC', 'type' => 'int'],
        ],
    ];

    const DEFAULT_SORT = 'created';

    const PLAYLIST_TYPE = 'playlists';
    const REALTIME_DEFAULT_TYPE = 'head_to_head';
    const REALTIME_TYPES = ['head_to_head', 'team_versus'];

    protected $casts = [
        'password' => PresentString::class,
    ];
    protected $table = 'multiplayer_rooms';
    protected $dates = ['starts_at', 'ends_at'];
    protected $attributes = [
        'participant_count' => 0,
    ];

    public ?array $preloadedRecentParticipants = null;

    /**
     * Using this requires the collection to be queried with withRecentParticipantIds scope.
     */
    public static function preloadRecentParticipants(Collection $rooms)
    {
        $allUserIds = $rooms->map->recent_participant_ids->flatten();
        $allUsersByKey = User::whereKey($allUserIds)->get()->keyBy('user_id');

        foreach ($rooms as $room) {
            $users = [];
            foreach ($room->recent_participant_ids as $userId) {
                $user = $allUsersByKey[$userId] ?? null;

                if ($user !== null) {
                    $users[] = $user;
                }
            }
            $room->preloadedRecentParticipants = $users;
        }
    }

    public static function search($params)
    {
        $query = static::query();

        $mode = presence(get_string($params['mode'] ?? null));
        $user = $params['user'];
        $sort = $params['sort'] ?? null;

        $category = presence(get_string($params['category'] ?? null)) ?? 'any';
        switch ($category) {
            case 'any':
                $query->where('type', static::PLAYLIST_TYPE);
                break;
            case 'realtime':
                $query->whereIn('type', static::REALTIME_TYPES);
                break;
            default:
                $query->where([
                    'type' => static::PLAYLIST_TYPE,
                    'category' => $category,
                ]);
        }

        switch ($mode) {
            case 'ended':
                $query->ended();
                $sort ??= 'ended';
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

        $cursorHelper = static::makeDbCursorHelper($sort);
        $query->cursorSort($cursorHelper, get_arr($params['cursor'] ?? null));

        $limit = clamp(get_int($params['limit'] ?? 250), 1, 250);
        $query->limit($limit);

        return [
            'cursorHelper' => $cursorHelper,
            'query' => $query,
            'search' => ['limit' => $limit, 'sort' => $cursorHelper->getSortName()],
        ];
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

    public function scopeWithRecentParticipantIds($query, ?int $limit = null)
    {
        $limit ??= 10;

        if ($query->getQuery()->columns === null) {
            $query = $query->select();
        }

        $highScore = new UserScoreAggregate();

        return $query->selectSub("
            SELECT json_arrayagg(user_id)
            FROM (
                SELECT user_id
                FROM {$highScore->getTable()}
                WHERE
                    {$highScore->qualifyColumn('room_id')} = {$this->qualifyColumn($this->getKeyName())}
                    AND (
                        {$this->qualifyColumn('type')} = {$this->getGrammar()->quoteString(static::PLAYLIST_TYPE)}
                        OR {$highScore->qualifyColumn('in_room')}
                    )
                ORDER BY updated_at DESC
                LIMIT {$limit}
            ) recent_participants
        ", 'recent_participant_ids');
    }

    public function hasEnded()
    {
        return $this->ends_at !== null && Carbon::now()->gte($this->ends_at);
    }

    public function isRealtime()
    {
        static $realtimeTypes;

        $realtimeTypes ??= new Set(static::REALTIME_TYPES);

        return $realtimeTypes->contains($this->type);
    }

    public function isScoreSubmissionStillAllowed()
    {
        // TODO: move grace period to config or use the beatmap's duration
        return $this->ends_at === null || Carbon::now()->lte($this->ends_at->addMinutes(5));
    }

    public function getRecentParticipantIdsAttribute()
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => json_decode($this->attributes['recent_participant_ids'], true) ?? []
        );
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

    public function participants(): HasMany
    {
        $query = $this->userHighScores();

        // only return users currently inside for open realtime room
        if ($this->isRealtime() && $this->ends_at === null) {
            $query->where(['in_room' => true]);
        }

        return $query;
    }

    public function recentParticipants(): array
    {
        if ($this->preloadedRecentParticipants !== null) {
            return $this->preloadedRecentParticipants;
        }

        return $this
            ->participants()
            ->select('user_id')
            ->with('user')
            ->orderBy('updated_at', 'DESC')
            ->limit(50)
            ->get()
            ->pluck('user')
            ->all();
    }

    public function startGame(User $owner, array $rawParams)
    {
        priv_check_user($owner, 'MultiplayerRoomCreate')->ensureCan();

        $params = get_params($rawParams, null, [
            'category',
            'duration:int',
            'ends_at:time',
            'max_attempts:int',
            'name',
            'password',
            'playlist:array',
            'type',
        ], ['null_missing' => true]);

        $this->fill([
            'max_attempts' => $params['max_attempts'],
            'name' => $params['name'],
            'starts_at' => now(),
            'type' => $params['type'],
            'user_id' => $owner->getKey(),
        ]);

        $this->setRelation('user', $owner);

        // TODO: remove category params support (and forcing default type) once client sends type parameter
        if ($this->isRealtime() || $params['category'] === 'realtime') {
            if (!in_array($this->type, static::REALTIME_TYPES, true)) {
                $this->type = static::REALTIME_DEFAULT_TYPE;
            }
            // only for realtime rooms for now
            $this->password = $params['password'];
            $this->ends_at = now()->addSeconds(30);
        } else {
            $this->type = static::PLAYLIST_TYPE;
            if ($params['ends_at'] !== null) {
                $this->ends_at = $params['ends_at'];
            } elseif ($params['duration'] !== null) {
                $this->ends_at = $this->starts_at->copy()->addMinutes($params['duration']);
            }
        }

        $this->assertValidStartGame();

        if (!is_array($params['playlist'])) {
            throw new InvariantException("field 'playlist' must an an array");
        }

        $playlistItems = [];
        foreach ($params['playlist'] as $item) {
            $playlistItems[] = PlaylistItem::fromJsonParams($owner, $item);
        }

        $playlistItemsCount = count($playlistItems);

        if ($this->isRealtime() && $playlistItemsCount !== 1) {
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

    private function assertUserRoomAllowance()
    {
        $query = static::active()->startedBy($this->user);

        if ($this->isRealtime()) {
            $query->whereIn('type', static::REALTIME_TYPES);
            $max = 1;
        } else {
            $query->where('type', static::PLAYLIST_TYPE);
            $max = $this->user->maxMultiplayerRooms();
        }

        if ($query->count() >= $max) {
            throw new InvariantException('number of simultaneously active rooms reached');
        }
    }

    private function assertValidCompletePlay()
    {
        if (!$this->isScoreSubmissionStillAllowed()) {
            throw new InvariantException('Room is no longer accepting scores.');
        }
    }

    private function assertValidStartGame()
    {
        $this->assertUserRoomAllowance();

        foreach (['ends_at', 'name'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("'{$field}' is required");
            }
        }

        if (!$this->isRealtime() && $this->starts_at->addMinutes(30)->gt($this->ends_at)) {
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
