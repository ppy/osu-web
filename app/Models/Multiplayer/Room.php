<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Multiplayer;

use App\Casts\PresentString;
use App\Exceptions\InvariantException;
use App\Models\Beatmap;
use App\Models\Chat\Channel;
use App\Models\Model;
use App\Models\ScoreToken;
use App\Models\Season;
use App\Models\SeasonRoom;
use App\Models\Traits\WithDbCursorHelper;
use App\Models\User;
use App\Traits\Memoizes;
use App\Transformers\Multiplayer\RoomTransformer;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Ds\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $category
 * @property string $status
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
 * @property \Illuminate\Database\Eloquent\Collection $scoreLinks ScoreLink
 * @property-read Collection<\App\Models\Season> $seasons
 * @property \Carbon\Carbon $starts_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @property string $type
 * @property string $queue_mode
 * @property bool $auto_skip
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

    const CATEGORIES = ['normal', 'spotlight', 'featured_artist', 'daily_challenge'];
    const TYPE_GROUPS = [
        'playlists' => [self::PLAYLIST_TYPE],
        'realtime' => self::REALTIME_TYPES,
    ];

    const PLAYLIST_TYPE = 'playlists';
    const REALTIME_DEFAULT_TYPE = 'head_to_head';
    const REALTIME_TYPES = ['head_to_head', 'team_versus'];

    const PLAYLIST_QUEUE_MODE = 'host_only';
    const REALTIME_DEFAULT_QUEUE_MODE = 'host_only';
    const REALTIME_QUEUE_MODES = [ 'host_only', 'all_players', 'all_players_round_robin' ];

    public ?array $preloadedRecentParticipants = null;

    protected $attributes = [
        'participant_count' => 0,
    ];
    protected $casts = [
        'auto_skip' => 'boolean',
        'ends_at' => 'datetime',
        'password' => PresentString::class,
        'starts_at' => 'datetime',
    ];
    protected array $macros = [
        'dailyChallengeFor',
    ];
    protected $table = 'multiplayer_rooms';

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

    public static function responseJson(array $rawParams): array
    {
        $typeGroup = $rawParams['type_group'] ?? null;

        $search = static::search($rawParams, 50);

        [$rooms, $hasMore] = $search['query']->with([
            'playlist.beatmap',
            'host',
        ])->getWithHasMore();

        $rooms->each->findAndSetCurrentPlaylistItem();
        $rooms->loadMissing('currentPlaylistItem.beatmap.beatmapset');

        $response['rooms'] = json_collection($rooms, new RoomTransformer(), ['current_playlist_item.beatmap.beatmapset', 'difficulty_range', 'host', 'playlist_item_stats']);

        if ($typeGroup !== null) {
            $response['type_group'] = $typeGroup;
        }

        return [
            ...$response,
            ...cursor_for_response($search['cursorHelper']->next($rooms, $hasMore)),
        ];
    }

    public static function search(array $rawParams, ?int $maxLimit = null)
    {
        $params = get_params($rawParams, null, [
            'category',
            'limit:int',
            'mode',
            'season_id:int',
            'sort',
            'type_group',
            'user:any',
        ], ['null_missing' => true]);

        $maxLimit ??= 250;
        $user = $params['user'];
        $seasonId = $params['season_id'];
        $sort = $params['sort'];
        $category = $params['category'];
        $typeGroup = $params['type_group'];

        // support old query string param
        // TODO: redirect instead?
        if ($category === 'realtime') {
            $typeGroup = 'realtime';
            $category = null;
        }

        if (!array_key_exists($typeGroup, static::TYPE_GROUPS)) {
            $typeGroup = 'playlists';
        }

        $query = static::whereIn('type', static::TYPE_GROUPS[$typeGroup]);

        if (isset($seasonId)) {
            $query->whereRelation('seasons', 'seasons.id', $seasonId);
        }

        if (in_array($category, static::CATEGORIES, true)) {
            $query->where('category', $category);
        }

        switch ($params['mode']) {
            case 'all':
                break;
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
        $query->cursorSort($cursorHelper, cursor_from_params($rawParams));

        $limit = \Number::clamp($params['limit'] ?? $maxLimit, 1, $maxLimit);
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

    /**
     * See getCurrentPlaylistItemIdAttribute.
     */
    public function currentPlaylistItem()
    {
        return $this->belongsTo(PlaylistItem::class, 'current_playlist_item_id');
    }

    public function macroDailyChallengeFor(): \Closure
    {
        return fn (Builder $query, CarbonImmutable $date): ?static
            => static::dailyChallenges()
                ->whereBetween('starts_at', [$date->startOfDay(), $date->endOfDay()])
                ->last();
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function playlist()
    {
        return $this->hasMany(PlaylistItem::class);
    }

    public function scoreLinks()
    {
        return $this->hasMany(ScoreLink::class);
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, SeasonRoom::class);
    }

    public function userHighScores()
    {
        return $this->hasMany(UserScoreAggregate::class);
    }

    public function scopeActive($query)
    {
        return $query
            ->where('starts_at', '<=', Carbon::now())
            ->where(function ($q) {
                $q->where('ends_at', '>', Carbon::now())->orWhereNull('ends_at');
            });
    }

    public function scopeDailyChallenges(Builder $query): Builder
    {
        return $query->where('category', 'daily_challenge');
    }

    public function scopeEnded($query)
    {
        return $query->where('ends_at', '<', Carbon::now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->whereIn('category', ['featured_artist', 'spotlight']);
    }

    public function scopeHasParticipated($query, User $user)
    {
        return $query->whereHas(
            'userHighScores',
            fn ($q) => $q->where('user_id', $user->getKey()),
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

    public function difficultyRange()
    {
        $extraQuery = true;

        if ($this->relationLoaded('playlist')) {
            if ($this->playlist->count() > 0) {
                $firstItem = $this->playlist[0];

                if ($firstItem->relationLoaded('beatmap')) {
                    $extraQuery = false;
                    foreach ($this->playlist as $item) {
                        $rating = $item->beatmap->difficultyrating;
                        $max ??= $rating;
                        $min ??= $rating;

                        if ($max < $rating) {
                            $max = $rating;
                        } elseif ($min > $rating) {
                            $min = $rating;
                        }
                    }
                }
            } else {
                $extraQuery = false;
            }
        }

        if ($extraQuery) {
            $range = Beatmap::selectRaw('
                MIN(difficultyrating) as min_difficulty,
                MAX(difficultyrating) as max_difficulty
            ')->whereIn('beatmap_id', $this->playlist()->select('beatmap_id'))->first();
            $max = $range->max_difficulty;
            $min = $range->min_difficulty;
        }

        return [
            'max' => $max ?? 0,
            'min' => $min ?? 0,
        ];
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

    /**
     * This allows nested preloading of playlist item relations.
     *
     * playlist should be preloaded beforehand unless it's for single Room model.
     */
    public function getCurrentPlaylistItemIdAttribute(): ?int
    {
        return $this->findAndSetCurrentPlaylistItem()?->getKey();
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
        $scoreLinkQuery = ScoreLink
            ::whereHas('playlistItem', fn ($q) => $q->where('room_id', $this->getKey()))
            ->select('user_id');

        foreach (User::whereIn('user_id', $scoreLinkQuery)->get() as $user) {
            UserScoreAggregate::new($user, $this);
        }
    }

    public function completePlay(ScoreToken $scoreToken, array $params): ScoreLink
    {
        priv_check_user($scoreToken->user, 'MultiplayerScoreSubmit', $this)->ensureCan();

        $this->assertValidCompletePlay();

        return $this->getConnection()->transaction(function () use ($params, $scoreToken) {
            $scoreLink = ScoreLink::complete($scoreToken, $params);
            $user = $scoreLink->user;
            $agg = UserScoreAggregate::new($user, $this);
            $agg->addScoreLink($scoreLink);
            if ($this->category === 'daily_challenge' && $agg->total_score > 0) {
                $stats = $user->dailyChallengeUserStats()->firstOrNew();
                $stats->updateStreak(true, $this->starts_at->toImmutable()->startOfDay());
                $stats->save();
            }

            return $scoreLink;
        });
    }

    public function findAndSetCurrentPlaylistItem(): ?PlaylistItem
    {
        return $this->memoize(__FUNCTION__, function () {
            if ($this->playlist->count() === 0) {
                $ret = null;
            } else {
                if ($this->isRealtime()) {
                    $groupedItems = $this->playlist->groupBy('expired');

                    // the key is casted to int
                    $ret = isset($groupedItems[0])
                        ? $groupedItems[0]->reduce(function (?PlaylistItem $prevItem, PlaylistItem $i) {
                            if ($prevItem === null) {
                                return $i;
                            }

                            return $i->playlist_order < $prevItem->playlist_order
                                ? $i
                                : $prevItem;
                        })
                        : $groupedItems[1]->reduce(function (?PlaylistItem $prevItem, PlaylistItem $i) {
                            if ($prevItem === null) {
                                return $i;
                            }

                            return $i->played_at > $prevItem->played_at
                                ? $i
                                : $prevItem;
                        });
                } else {
                    $ret = $this->playlist[0];
                }
            }

            $this->setRelation('currentPlaylistItem', $ret);

            return $ret;
        });
    }

    public function join(User $user)
    {
        $this->channel->addUser($user);
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

    public function playlistItemStats(): array
    {
        $active = $this->playlist->whereStrict('expired', false);
        $activeCount = $active->count();

        return [
            'count_active' => $activeCount,
            'count_total' => $this->playlist->count(),
            'ruleset_ids' => ($activeCount === 0 ? $this->playlist : $active)->pluck('ruleset_id')->unique()->values(),
        ];
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

    public function startGame(User $host, array $rawParams, array $extraParams = [])
    {
        priv_check_user($host, 'MultiplayerRoomCreate')->ensureCan();

        $params = get_params($rawParams, null, [
            'category',
            'duration:int',
            'ends_at:time',
            'max_attempts:int',
            'name',
            'password',
            'playlist:array',
            'type',
            'queue_mode',
            'auto_start_duration:int',
            'auto_skip:bool',
        ], ['null_missing' => true]);

        $this->fill([
            'max_attempts' => $params['max_attempts'],
            'name' => app('chat-filters')->filter($params['name']),
            'starts_at' => now(),
            'type' => $params['type'],
            'queue_mode' => $params['queue_mode'],
            'auto_start_duration' => $params['auto_start_duration'],
            'auto_skip' => $params['auto_skip'] ?? false,
            'user_id' => $host->getKey(),
            ...$extraParams,
        ]);

        $this->setRelation('host', $host);

        // TODO: remove category params support (and forcing default type) once client sends type parameter
        if ($this->isRealtime() || $params['category'] === 'realtime') {
            if (!in_array($this->type, static::REALTIME_TYPES, true)) {
                $this->type = static::REALTIME_DEFAULT_TYPE;
            }
            if (!in_array($this->queue_mode, static::REALTIME_QUEUE_MODES, true)) {
                $this->queue_mode = static::REALTIME_DEFAULT_QUEUE_MODE;
            }
            if ($this->auto_start_duration === null) {
                $this->auto_start_duration = 0;
            }
            // only for realtime rooms for now
            $this->password = $params['password'];
            $this->ends_at = now()->addSeconds(30);
        } else {
            $this->type = static::PLAYLIST_TYPE;
            $this->queue_mode = static::PLAYLIST_QUEUE_MODE;
            $this->auto_start_duration = 0;
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
            $playlistItems[] = PlaylistItem::fromJsonParams($host, $item);
        }

        $playlistItemsCount = count($playlistItems);

        if ($this->isRealtime() && $playlistItemsCount !== 1) {
            throw new InvariantException('realtime room must have exactly one playlist item');
        }

        if ($playlistItemsCount < 1) {
            throw new InvariantException('room must have at least one playlist item');
        }

        PlaylistItem::assertBeatmapsExist($playlistItems);

        $this->getConnection()->transaction(function () use ($host, $playlistItems) {
            $this->save(); // need to persist to get primary key for channel name.

            $channel = Channel::createMultiplayer($this);
            $channel->addUser($host);

            $this->update(['channel_id' => $channel->channel_id]);

            foreach ($playlistItems as $playlistItem) {
                $playlistItem->room()->associate($this);
                $playlistItem->save();
            }
        });

        // to load db-level default attributes
        return $this->fresh();
    }

    /**
     * @throws InvariantException
     */
    public function endGame(User $requestingUser)
    {
        priv_check_user($requestingUser, 'MultiplayerRoomDestroy', $this)->ensureCan();

        if ($this->isRealtime()) {
            throw new InvariantException('Realtime rooms cannot be closed.');
        }

        $gracePeriodMinutes = $GLOBALS['cfg']['osu']['multiplayer']['room_close_grace_period_minutes'];
        if ($this->starts_at->addMinutes($gracePeriodMinutes)->isPast()) {
            throw new InvariantException('The grace period for closing this room has expired.');
        }

        $this->ends_at = now();
        $this->save();
    }

    public function startPlay(User $user, PlaylistItem $playlistItem, int $buildId)
    {
        priv_check_user($user, 'MultiplayerScoreSubmit', $this)->ensureCan();

        $this->assertValidStartPlay($user, $playlistItem);

        return $this->getConnection()->transaction(function () use ($buildId, $user, $playlistItem) {
            $agg = UserScoreAggregate::new($user, $this);
            if ($agg->wasRecentlyCreated) {
                $this->incrementInstance('participant_count');
            }

            $agg->updateUserAttempts();

            $playlistItemAgg = PlaylistItemUserHighScore::new($user->getKey(), $playlistItem->getKey());
            $playlistItemAgg->updateUserAttempts();

            return ScoreToken::create([
                'beatmap_id' => $playlistItem->beatmap_id,
                'build_id' => $buildId,
                'playlist_item_id' => $playlistItem->getKey(),
                'ruleset_id' => $playlistItem->ruleset_id,
                'user_id' => $user->getKey(),
            ]);
        });
    }

    public function topScores()
    {
        return $this->userHighScores()->forRanking()->with('user.country');
    }

    private function assertHostRoomAllowance()
    {
        $query = static::active()->startedBy($this->host);

        if ($this->isRealtime()) {
            $query->whereIn('type', static::REALTIME_TYPES);
            $max = 1;
        } else {
            $query->where('type', static::PLAYLIST_TYPE);
            $max = $this->host->maxMultiplayerRooms();
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
        $this->assertHostRoomAllowance();

        foreach (['ends_at', 'name'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("'{$field}' is required");
            }
        }

        if (!$this->isRealtime() && $this->starts_at->addMinutes(30)->gt($this->ends_at)) {
            throw new InvariantException("'ends_at' must be at least 30 minutes after 'starts_at'");
        }

        if ($this->starts_at->addDays($this->host->maxMultiplayerDuration())->lt($this->ends_at)) {
            throw new InvariantException(osu_trans('multiplayer.room.errors.duration_too_long'));
        }

        if ($this->max_attempts !== null) {
            $maxAttemptsLimit = $GLOBALS['cfg']['osu']['multiplayer']['max_attempts_limit'];
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

        $userId = $user->getKey();
        if ($this->max_attempts !== null) {
            $roomStats = $this->userHighScores()->where('user_id', $userId)->first();
            if ($roomStats !== null && $roomStats->attempts >= $this->max_attempts) {
                throw new InvariantException('You have reached the maximum number of tries allowed.');
            }
        }

        if ($playlistItem->max_attempts !== null) {
            $playlistItemStats = $playlistItem->highScores()->where('user_id', $userId)->first();
            if ($playlistItemStats !== null && $playlistItemStats->attempts >= $playlistItem->max_attempts) {
                throw new InvariantException('You have reached the maximum number of tries allowed.');
            }
        }

        if ($playlistItem->expired) {
            throw new InvariantException('Cannot play an expired playlist item.');
        }

        if ($playlistItem->played_at !== null) {
            throw new InvariantException('Cannot play a playlist item that has already been played.');
        }

        // ensure the playlist item itself is in a valid state.
        // this is a defensive measure to prevent further breakage if the item's state is inconsistent
        // due to an external modification from osu-server-spectator.
        $playlistItem->assertValid();
    }
}
